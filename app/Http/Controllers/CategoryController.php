<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\ListCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryListResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PaginationResource;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Category/Index');
    }

    public function list(ListCategoryRequest $request): Response
    {
        $validated = $request->validated();

        $per_page = $validated["per_page"] ?? 10;
        $search = $validated["search"] ?? null;

        $categories = Category::query()
            ->where(["account_id" => $request->get("account_id")])
            ->when($search, fn($query) => $query->where("name", "like", "%$search%"));

        $sortColumn = $validated["sort_by"] ?? "created_at";
        $sortOrder = $validated["sort_order"] ?? "asc";

        $categories = $categories->orderBy($sortColumn, $sortOrder)
            ->paginate($per_page)
            ->withQueryString();

        return Inertia::render('Category/List', [
            "categories" => CategoryListResource::collection($categories->items()),
            "links" => new PaginationResource($categories),
            "filters" => $request->only(["search", "sort_by", "sort_order"]),
        ]);
    }

    public function view(int $category_id): Response
    {
        $category = Category::query()->where([
            "account_id" => request()->get("account_id"),
            "id" => $category_id
        ])->first();
        if (!$category) {
            return redirect()->route("category.list")->with([
                "message" => "Category not found"
            ]);
        }

        return Inertia::render('Category/View', [
            "category" => new CategoryResource($category)
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Category/Create');
    }

    public function store(CreateCategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Category::create([
            "account_id" => $request->get("account_id"),
            "name" => $validated["name"],
            "type" => $validated["type"],
            "color" => $validated["color"],
            "icon" => $validated["icon"],
        ]);

        return redirect()->route("category.list")->with([
            "message" => "Category created successfully"
        ]);
    }

    public function update(int $category_id): Response|RedirectResponse
    {
        $category = Category::query()->where([
            "account_id" => request()->get("account_id"),
            "id" => $category_id
        ])->first();
        if (!$category) {
            return redirect()->route("category.list")->with([
                "message" => "Category not found"
            ]);
        }

        return Inertia::render('Category/Update', [
            "category" => new CategoryResource($category)
        ]);
    }

    public function edit(int $category_id, UpdateCategoryRequest $request)
    {
        $category = Category::query()->where([
            "account_id" => request()->get("account_id"),
            "id" => $category_id
        ])->first();

        if (!$category) {
            return redirect()->route("category.list")->with([
                "message" => "Category not found"
            ]);
        }
        $validated = $request->validated();

        $category->update([
            "name" => $validated["name"],
            "type" => $validated["type"],
            "color" => $validated["color"],
            "icon" => $validated["icon"],
        ]);

        return redirect()->route("category.list")->with([
            "message" => "Category updated successfully"
        ]);
    }

    public function delete(int $category_id): RedirectResponse
    {
        $category = Category::query()->where([
            "account_id" => request()->get("account_id"),
            "id" => $category_id
        ])->first();

        if (!$category) {
            return redirect()->route("category.list")->with([
                "message" => "Category not found"
            ]);
        }

        $category->delete();

        return redirect()->route("category.list")->with([
            "message" => "Category deleted successfully"
        ]);
    }
}

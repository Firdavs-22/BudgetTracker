<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\CreateTransactionRequest;
use App\Http\Requests\Transaction\ListTransactionRequest;
use App\Http\Requests\Transaction\UpdateTransactionRequest;
use App\Http\Resources\CategorySelectReaource;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\TransactionListResource;
use App\Http\Resources\TransactionResource;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TransactionController extends Controller
{
    public function index(): Response
    {
        // get the today transactions
        return Inertia::render('Transaction/Index');
    }

    public function view(int $transaction_id): Response|RedirectResponse
    {
        $transaction = Transaction::query()->find($transaction_id);

        if (!$transaction) {
            return redirect()->route("transaction.list")->with([
                "message" => "Transaction not found"
            ]);
        }

        return Inertia::render('Transaction/View', [
            "transaction" => new TransactionResource($transaction),
        ]);
    }
    public function list(ListTransactionRequest $request): Response
    {
        $validated = $request->validated();

        $per_page = $validated["per_page"] ?? 10;
        $search = $validated["search"] ?? null;

        $categories = Transaction::query()
            ->where(["account_id" => $request->get("account_id")])
            ->when($search, fn($query) => $query->where("name", "like", "%$search%"))
            ->when($validated["category_id"], fn($query) => $query->where("category_id", $validated["category_id"]))
            ->with(["category"]);

        $sortColumn = $validated["sort_by"] ?? "created_at";
        $sortOrder = $validated["sort_order"] ?? "asc";

        $categories = $categories->orderBy($sortColumn, $sortOrder)
            ->paginate($per_page)
            ->withQueryString();

        return Inertia::render('Transaction/List', [
            "transaction" => TransactionListResource::collection($categories->items()),
            "links" => new PaginationResource($categories),
            "filters" => $request->only(["search", "sort_by", "sort_order"]),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Transaction/Create', [
            "categories" => fn() => CategorySelectReaource::collection(Category::all()),
        ]);
    }

    public function store(CreateTransactionRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $category = Category::find($validated["category_id"]);

        Transaction::create([
            "account_id" => $validated["account_id"],
            "category_id" => $validated["category_id"],
            "amount" => $validated["amount"],
            "type" => $category->type,
            "description" => $validated["description"] ?? null,
        ]);

        return redirect()->route("transaction.list")->with([
            "message" => "Transaction created successfully"
        ]);
    }

    public function update(int $transaction_id): Response|RedirectResponse
    {
        $transaction = Transaction::find($transaction_id);

        if (!$transaction) {
            return redirect()->route("transaction.list")->with([
                "message" => "Transaction not found"
            ]);
        }

        return Inertia::render('Transaction/Edit', [
            "transaction" => new TransactionResource($transaction),
            "categories" => fn() => CategorySelectReaource::collection(Category::all()),
        ]);
    }

    public function edit(UpdateTransactionRequest $request, int $transaction_id): RedirectResponse
    {
        $validated = $request->validated();

        $transaction = Transaction::query()->find($transaction_id);

        if (!$transaction) {
            return redirect()->route("transaction.list")->with([
                "message" => "Transaction not found"
            ]);
        }

        $category = Category::query()->find($validated["category_id"]);

        $transaction->update([
            "category_id" => $validated["category_id"],
            "amount" => $validated["amount"],
            "type" => $category->type,
            "description" => $validated["description"] ?? null,
        ]);

        return redirect()->route("transaction.list")->with([
            "message" => "Transaction updated successfully"
        ]);
    }

    public function destroy(int $transaction_id): RedirectResponse
    {
        $transaction = Transaction::query()->find($transaction_id);

        if (!$transaction) {
            return redirect()->route("transaction.list")->with([
                "message" => "Transaction not found"
            ]);
        }

        $transaction->delete();

        return redirect()->route("transaction.list")->with([
            "message" => "Transaction deleted successfully"
        ]);
    }
}

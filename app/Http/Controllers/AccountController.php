<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\CreateAccountRequest;
use App\Http\Requests\Account\SelectAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Resources\AccountResource;
use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class AccountController extends Controller
{
    public function select(SelectAccountRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        session()->put('account_id', $validated['account_id']);

        return redirect('/dashboard');
    }

    public function index(): Response
    {
        return Inertia::render("Account/Index", [
            "accounts" => fn() => AccountResource::collection(auth()->user()->accounts),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render("Account/Create");
    }

    public function store(CreateAccountRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $request->user()->accounts()->create([
            "name" => $validated["name"],
            "description" => $validated["description"],
            "currency" => $validated["currency"],
        ]);

        return redirect()->route("account.index")->with("success", "Account created successfully.");
    }

    public function update(int $account_id): Response|RedirectResponse
    {
        $account = Account::query()
            ->where("id", $account_id)
            ->where("user_id", auth()->user()->id)
            ->first();

        if (!$account) return back();

        return Inertia::render("Account/Edit", [
            "account" => fn() => new AccountResource($account),
        ]);
    }

    public function edit(int $account_id, UpdateAccountRequest $request)
    {
        $account = Account::query()
            ->where("id", $account_id)
            ->where("user_id", auth()->user()->id)
            ->first();

        if (!$account) return redirect()->route("account.index")->with("error", "Account not found.");

        $validated = $request->validated();

        $account->update([
            "name" => $validated["name"],
            "description" => $validated["description"],
            "currency" => $validated["currency"],
        ]);

        return redirect()->route("account.index")->with("success", "Account updated successfully.");
    }

    public function delete(int $account_id): RedirectResponse
    {
        $account = Account::query()
            ->where("id", $account_id)
            ->where("user_id", auth()->user()->id)
            ->first();

        if (!$account) return redirect()->route("account.index")->with("error", "Account not found.");
        $account->delete();
        $sessionAccountId = session()->get('account_id');
        if ($sessionAccountId == $account->id) {
            session()->forget('account_id');
        }

        return redirect()->route("account.index")->with("success", "Account deleted successfully.");
    }
}

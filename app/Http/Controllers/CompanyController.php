<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Services\Company\CompanyServiceInterface;
use App\Services\Users\UserServiceInterface;

class CompanyController extends Controller
{
    public function __construct(
        protected CompanyServiceInterface $companyService,
        protected UserServiceInterface $userService
    ) {
    }

    public function create(CreateCompanyRequest $request)
    {
        $company = $this->companyService->create($this->userService->authed(), $request->validated());
        return CompanyResource::make($company);
    }
}

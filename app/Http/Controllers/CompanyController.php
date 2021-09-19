<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Services\Company\Interfaces\CreatesCompany;
use App\Services\Users\GetsAuthedUser;

class CompanyController extends Controller
{
    public function __construct(
        protected CreatesCompany $companyService,
        protected GetsAuthedUser $getsAuthedUserService
    ) {
    }

    public function create(CreateCompanyRequest $request)
    {
        $company = $this->companyService->create($this->getsAuthedUserService->authed(), $request->validated());
        return CompanyResource::make($company);
    }
}

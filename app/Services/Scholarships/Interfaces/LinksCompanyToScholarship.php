<?php

namespace App\Services\Scholarships\Interfaces;

use App\Models\Company\CompanyInterface;
use App\Models\Scholarship\ScholarshipInterface;

interface LinksCompanyToScholarship
{
    public function linkCompanyToScholarship(CompanyInterface $company, ScholarshipInterface $scholarship);
}

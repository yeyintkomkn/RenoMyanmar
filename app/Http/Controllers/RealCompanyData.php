<?php
/**
 * Created by PhpStorm.
 * User: Alintan
 * Date: 12/25/2018
 * Time: 10:37 AM
 */

namespace App\Http\Controllers;


use App\Company;

class RealCompanyData extends CompanyData
{
    public function __construct($id)
    {
        $company=Company::findOrFail($id);
        $this->setCompanyInfoArr($company);
        $this->setCategoriesArr($company->id);
        $this->setFeedbackArr($company->id);
        $this->setProjectArr($company->id);
        $this->setSuggestCompanyArr();
    }


}
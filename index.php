<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('includes/useRequirements.php');
include('includes/requirement.php');
include('includes/asset.php');
include('includes/company.php');
include('includes/candidate.php');

//Instead of the "[]", It would retrieve data from the database
$jobsFromDb = [
    ['name' => 'Company A', 'require' => [
        ['type' => 'place', 'name' => 'apartment'],
        ['type' => 'place', 'name' => 'house'],
        ['type' => 'insurance', 'name' => 'property insurance']
    ]]
    ,['name' => 'Company B', 'require' => [
        ['type' => 'vehicle', 'name' => 'car', 'extra' => 4]
        ,['type' => 'vehicle', 'name' => 'car', 'extra' => 5]
        ,['type' => 'document', 'name' => 'driver`s license']
        ,['type' => 'insurance', 'name' => 'car insurance']
    ]]
    ,['name' => 'Company C', 'require' => [
        ['type' => 'document', 'name' => 'social security number']
        ,['type' => 'visa', 'name' => 'work permit']
    ]]
    ,['name' => 'Company D', 'require' => [
        ['type' => 'place', 'name' => 'apartment']
        ,['type' => 'place', 'name' => 'flat']
        ,['type' => 'place', 'name' => 'house']
    ]]
    ,['name' => 'Company E', 'require' => [
        ['type' => 'document', 'name' => 'driver`s license']
        ,['type' => 'vehicle', 'name' => 'car', 'extra' => 2]
        ,['type' => 'vehicle', 'name' => 'car', 'extra' => 3]
        ,['type' => 'vehicle', 'name' => 'car', 'extra' => 4]
        ,['type' => 'vehicle', 'name' => 'car', 'extra' => 5]
    ]]
    ,['name' => 'Company F', 'require' => [
        ['type' => 'vehicle', 'name' => 'scooter']
        ,['type' => 'vehicle', 'name' => 'bike']
        ,['type' => 'vehicle', 'name' => 'motorcycle']
        ,['type' => 'document', 'name' => 'driver`s license']
        ,['type' => 'insurance', 'name' => 'motorcycle insurance']
    ]]
    ,['name' => 'Company G', 'require' => [
        ['type' => 'certificate', 'name' => 'massage qualification certificate']
        ,['type' => 'insurance', 'name' => 'liability insurance']
    ]]
    ,['name' => 'Company H', 'require' => [
        ['type' => 'place', 'name' => 'storage']
        ,['type' => 'place', 'name' => 'garage']
    ]]
    ,['name' => 'Company J', 'require' => []]
    ,['name' => 'Company K', 'require' => [
        ['type' => 'account', 'name' => 'storage']
    ]]
];

//SPL Array to run faster at the `for()`
$jobs = new SplFixedArray(10000);
$jobsSpl = $jobs::fromArray($jobsFromDb);
unset($jobsFromDb);

$johnDoeAssets = [
    ['type' => 'vehicle', 'name' => 'bike']
    ,['type' => 'document', 'name' => 'driver`s license']
];

$me = new Candidate('John Doe', $johnDoeAssets);

$acceptableCompanies = [];

for ($i = 0; $i < count($jobsSpl); $i++)
{
    $current = $jobsSpl[$i];

    $company = new Company($current['name'], $current['require']);

    //If the candidate match the requirements, then set It into the array $acceptableCompanies
    if ($me->matchRequirements($company->getArrayList(TRUE))){
        $acceptableCompanies[] = $company->getName();
    }
}

unset($current);
unset($requirements);
unset($company);

echo '<h1>Acceptable Companies</h1>';

echo 'For: <strong>' . $me->getName() . ':</strong>';

echo '<ul>';

foreach ($acceptableCompanies as $companyName)
{
    echo '<li>' . $companyName . '</li>';
}

echo '</ul>';

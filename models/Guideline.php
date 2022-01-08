<?php


namespace app\models;


class Guideline extends \app\core\db\DbModel
{
    public string $sub_category_id = '';
    public string $guid_id = '';
    public string $guideline = '';
    public string $guid_status = '0';   // default value set for CREATED
    public string $last_modified_date = '';
    public string $activate_date = '';
    public string $expiry_date='';

    public static function tableName(): string
    {
        return 'guidelines';
    }

    public function attributes(): array
    {
        return [
            'sub_category_id',
            'guideline',
            'guid_status',
            'activate_date',
            'expiry_date'

        ];
    }

    public static function primaryKey(): string
    {
        return 'guid_id';
    }

    public function rules(): array
    {
        return [
            'sub_category_id' => [self::RULE_REQUIRED],
            'guideline' => [self::RULE_REQUIRED],
            'cat_id' => [self::RULE_REQUIRED],
            'guid_status' => [self::RULE_REQUIRED],
            'activate_date' => [self::RULE_REQUIRED],
            'expiry_date'=>[self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'sub_category_id' => "Select SubCategory",
            'guideline' => "Enter description",
            'cat_id' => "Select Category",
            'guid_status' => "save as draft",  // only state that can be determined at creation. others are set according to date.
            'activate_date' => "Select Activate Date",
            'expiry_date' => "Select Expiry Date"
        ];
    }

    public static function getCategoryID($guid_id)
    {
        $SQL = "SELECT cat_id FROM sub_categories WHERE sub_category_id = (SELECT sub_category_id FROM guidelines WHERE guid_id = :guid_id)";
        $statement = self::prepare($SQL);
        $statement->bindValue(":guid_id",$guid_id);
        $statement->execute();
        return $statement->fetch()[0];
    }

    /**
     * @return string
     */
    public function getSubCategoryId(): string
    {
        return $this->sub_category_id;
    }

    /**
     * @return string
     */
    public function getGuidId(): string
    {
        return $this->guid_id;
    }

    /**
     * @return string
     */
    public function getGuideline(): string
    {
        return $this->guideline;
    }

    /**
     * @return string
     */
    public function getGuidStatus(): string
    {
        return $this->guid_status;
    }

    /**
     * @return string
     */
    public function getLastModifiedDate(): string
    {
        return $this->last_modified_date;
    }

    /**
     * @return string
     */
    public function getActivateDate(): string
    {
        return $this->activate_date;
    }

    /**
     * @return string
     */
    public function getExpiryDate(): string
    {
        return $this->expiry_date;
    }

    /**
     * @param string $guid_status
     */
    public function setGuidStatus(string $guid_status): void
    {
        $this->guid_status = $guid_status;
    }



}

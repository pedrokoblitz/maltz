<?php

namespace Maltz\Mvc\ModelFeature;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait Translatable
{
    /**
     * /
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function getTranslations($item_id)
    {
        if (!is_int($item_id)) {
            throw new \Exception("Invalid input type", 1);
        }

        $sql = "SELECT slug, title, subtitle, excerpt, description, body, language FROM translations WHERE item_name=:item_name AND item_id=item_id";
        $result = $this->db->run($sql, array('item_name' => $this->slug, 'item_id' => $item_id));
        return $result;
    }

    /**
     * /
     * @param Record $record [description]
     */
    public function addTranslation(Record $record)
    {
        $fields = $record->getFieldsList();
        $values = $record->getInsertValueString();
        $sql = "INSERT INTO translations $fields, created VALUES $values, NOW()";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    /**
     * /
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function removeTranslation($item_id)
    {
        if (!is_int($item_id)) {
            throw new \Exception("Invalid input type", 1);
        }

        $sql = "DELETE FROM translations WHERE item_name=:item_name, item_id=:item_id";
        $result = $this->db->run($sql, array('item_name' => $this->slug,'item_id' => $item_id));
        return $result;
    }

    /**
     * /
     * @param  [type] $string [description]
     * @return [type]         [description]
     */
    public function generateSlug($string)
    {
        if (!is_string($string)) {
            throw new \Exception("Invalid input type", 1);
        }

        $string = preg_replace('~[^\\pL\d]+~u', '-', $string);
        $string = trim($string, '-');
        $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
        $string = strtolower($string);
        $string = preg_replace('~[^-\w]+~', '', $string);

        if (empty($string)) {
            $slug = 'n-a';
        }

        $slug = $string;
        $i = 1;
        $slugTpl = $slug . '-';
        while ($this->checkSlug($slug)) {
            $slug = $slugTpl . $i;
            $i++;
        }
        return $slug;
    }

    /**
     * /
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    protected function checkSlug($slug)
    {
        if (!is_string($slug)) {
            throw new \Exception("Invalid input type", 1);
        }

        $sql = "SELECT id FROM translations WHERE slug=:slug";
        $result = $this->db->run($sql, array('slug' => $slug));
        return $result->isSuccessful();
    }
}

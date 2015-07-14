<?php

namespace Maltz\Mvc;

trait Translatable
{
    public function getTranslations($item_id)
    {
        $sql = "SELECT slug, title, subtitle, excerpt, description, body FROM translations WHERE item_name=:item_name AND item_id=item_id";
        $resultado = $this->db->run($sql, array('item_name' => $this->slug, 'item_id' => $item_id));
        return $resultado;
    }

    public function addTranslation(Record $record)
    {
        $fields = $record->getFieldsList();
        $values = $record->getInsertValueString();
        $sql = "INSERT INTO translations $fields, created VALUES $values, NOW()";
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }

    public function removeTranslation($item_id)
    {
        $sql = "DELETE FROM translations WHERE item_name=:item_name, item_id=:item_id";
        $resultado = $this->db->run($sql, array('item_name' => $this->slug,'item_id' => $item_id));
        return $resultado;
    }

    public function generateSlug($string)
    {

        $string = preg_replace('~[^\\pL\d]+~u', '-', $string);
        $string = trim($string, '-');
        $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
        $string = strtolower($string);
        $string = preg_replace('~[^-\w]+~', '', $string);

        if (empty($string))
        {
            $slug = 'n-a';
        }

        $slug = $string;
        $i = 1;
        while ($this->checkSlug($slug)) {
            $c = (string) $i;
            $slug = $string . '-' . $c;
            $i++;
        }
        return $slug;
    }

    protected function checkSlug($slug)
    {
        $sql = "SELECT id FROM translations WHERE slug=:slug";
        $result = $this->db->run($sql, array('slug' => $slug));
        return $result->get('success');
    }
}
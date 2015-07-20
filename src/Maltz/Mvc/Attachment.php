<?php

namespace Maltz\Mvc;

trait Attachment
{
    public function addAttachment(Record $record)
    {
        $id = $record->get('id');
        $item_name = $record->get('item_name');
        $item_id = $record->get('item_id');
        $order = $record->get('order');

        if (!is_int($id) || !is_int($item_id) || !is_string($item_name) || !is_int($order)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $bind = array('group_name' => $this->slug, 'group_id' => $id, 'item_name' => $item_name, 'item_id' => $item_id);
        $sql = "INSERT INTO attachments (group_name, group_id, item_name, item_id, order) VALUES (:group_name, :group_id, :item_name, :item_id, :order)";
        $resultado = $this->db->run($sql, $bind);
        return $resultado;
    }

    public function removeAttachment(Record $record)
    {
        $id = $record->get('');
        $item_name = $record->get('');
        $item_id = $record->get('');

        if (!is_int($id) || !is_int($item_id) || !is_string($item_name)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $bind = array('group_name' => $this->slug, 'group_id' => $id, 'item_name' => $item_name, 'item_id' => $item_id);
        $sql = "DELETE FROM attachments WHERE group_name=:group_name, group_id=:group_id, item_name=:item_name, item_id=:item_id";
        $resultado = $this->db->run($sql, $bind);
        return $resultado;
    }

    public function removeAllAttachments(Record $record)
    {
        $id = $record->get('id');
        $item_name = $record->get('item_name');

        if (!is_int($id) || !is_string($item_name)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $bind = array('group_name' => $this->slug, 'group_id' => $id, 'item_name' => $item_name);
        $sql = "DELETE FROM attachments WHERE group_name=:group_name, group_id=:group_id, item_name=:item_name";
        $resultado = $this->db->run($sql, $bind);
        return $resultado;
    }

    public function getAllAttachments($id, $item_name)
    {
        if (!is_int($id) || !is_string($item_name)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $fields = 't2.id AS id, t3.slug AS slug, ';
        switch ($item_name) {
            case 'content':
                $fields .= 't3.title AS title, t3.subtitle AS subtitle, t3.description AS description, t3.excerpt AS excerpt, t3.body AS body ';
                break;
            case 'collection':
                $fields .= 't3.title AS title, t3.description AS description ';
                break;
            case 'resource':
                $fields .= 't2.filename AS filename, t2.filepath AS filepath, t2.url AS url, t2.embed AS embed, t3.title AS title, t3.description AS description ';
                break;
            case 'term':
                $fields .= 't3.title AS title, t3.description AS description ';
                break;
        }
        $fields .= 't4.name AS type';

        $item_table = $item_name . 's';
        $bind = array('group_name' => $this->slug, 'group_id' => $id, 'item_name' => $item_name);
        $sql = "SELECT $fields
        FROM attachments t1
            JOIN $item_table t2
                ON t1.item_id=t2.id
                AND t1.item_name=:item_name
            JOIN translations t3
                ON t2.id=t3.item_id
                AND t3.item_name=:item_name
            JOIN types t4
                ON t2.type_id=t4.id
        WHERE t1.group_name=:group_name
            AND t1.group_id=:group_id
        ORDER BY t1.order";
        $resultado = $this->db->run($sql, $bind);
        return $resultado;
    }
}

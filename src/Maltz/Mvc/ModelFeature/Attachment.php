<?php

namespace Maltz\Mvc\ModelFeature;

trait Attachment
{
    public function addAttachment(Record $record)
    {
        $id = $record->get('group_id');
        $item_name = $record->get('item_name');
        $item_id = $record->get('item_id');
        $order = $record->get('order');

        if (!is_int($id) || !is_int($item_id) || !is_string($item_name) || !is_int($order)) {
            throw new \Exception("Invalid input type", 1);
        }
        
        $bind = array('group_name' => $this->slug, 'group_id' => $id, 'item_name' => $item_name, 'item_id' => $item_id, 'order' => $order);
        $sql = "INSERT INTO attachments (group_name, group_id, item_name, item_id, `order`) VALUES (:group_name, :group_id, :item_name, :item_id, :order)";
        $result = $this->db->run($sql, $bind);
        return $result;
    }

    public function removeAttachment(Record $record)
    {
        $id = $record->get('id');
        $item_name = $record->get('item_name');
        $item_id = $record->get('item_id');

        if (!is_int($id) || !is_int($item_id) || !is_string($item_name)) {
            throw new \Exception("Invalid input type", 1);
        }
        
        $bind = array('group_name' => $this->slug, 'group_id' => $id, 'item_name' => $item_name, 'item_id' => $item_id);
        $sql = "DELETE FROM attachments WHERE group_name=:group_name, group_id=:group_id, item_name=:item_name, item_id=:item_id";
        $result = $this->db->run($sql, $bind);
        return $result;
    }

    public function removeAllAttachments(Record $record)
    {
        $id = $record->get('id');
        $item_name = $record->get('item_name');

        if (!is_int($id) || !is_string($item_name)) {
            throw new \Exception("Invalid input type", 1);
        }
        
        $bind = array('group_name' => $this->slug, 'group_id' => $id, 'item_name' => $item_name);
        $sql = "DELETE FROM attachments WHERE group_name=:group_name, group_id=:group_id, item_name=:item_name";
        $result = $this->db->run($sql, $bind);
        return $result;
    }

    public function getAllAttachments($id, $item_name)
    {
        if (!is_int($id) || !is_string($item_name)) {
            throw new \Exception("Invalid input type", 1);
        }

        $fields = 't2.id, t3.slug, ';
        switch ($item_name) {
        case 'content':
            $fields .= 't3.title, t3.subtitle, t3.description, t3.excerpt, t3.body ';
            break;
        case 'collection':
            $fields .= 't3.title, t3.description ';
            break;
        case 'resource':
            $fields .= 't2.filename, t2.filepath, t2.url, t2.embed, t3.title, t3.description ';
            break;
        case 'term':
            $fields .= 't3.title, t3.description ';
            break;
        }
        $fields .= 't4.name';

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
        $result = $this->db->run($sql, $bind);
        return $result;
    }
}

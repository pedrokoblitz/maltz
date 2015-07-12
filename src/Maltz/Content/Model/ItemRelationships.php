<?php

namespace Maltz\Content\Model;

trait ItemRelationships
{

    public function addResource($id, $item_id) {
        $sql = "INSERT INTO groups_items_relationships (group_name, group_id, item_name, item_id) VALUES (:group_name, :group_id, :item_name, :item_id)";
        $resultado = $this->db->run($sql, array('group_name' => $this->slug, 'group_id' => $id, 'item_name' => 'resource', 'item_id' => $item_id));
        return $resultado;
    }

    public function removeResource() {
        $sql = "DELETE FROM groups_items_relationships WHERE group_name=:group_name, group_id=:group_id, item_name=:item_name, item_id=:item_id";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function removeAllResources() {
        $sql = "DELETE FROM groups_items_relationships WHERE group_name=:group_name, group_id=:group_id, item_name=:item_name";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function getResource() {
        $sql = "";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function getAllResources() {
        $sql = "SELECT FROM groups_items_relationships t1
            JOIN resources t2
                ON t1.item_id=t2.id
                AND t1.item_name=:item_name
            WHERE t1.group_name=:group_name
            AND t1.group_id=:group_id";
        $resultado = $this->db->run($sql, array('group_name' => , 'group_id' => , 'item_name' => , 'item_id' => ));
        return $resultado;
    }

    public function addCollection() {
        $sql = "INSERT INTO groups_items_relationships (group_name, group_id, item_name, item_id) 
            VALUES (:group_name, :group_id, :item_name, :item_id)";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function removeCollection() {
        $sql = "DELETE FROM groups_items_relationships WHERE group_name=:group_name, group_id=:group_id, item_name=:item_name";
        $resultado = $this->db->run($sql, array('group_name' => , 'group_id' => , 'item_name' => , 'item_id' => ));
        return $resultado;
    }

    public function getCollections() {
        $sql = "SELECT FROM groups_items_relationships t1
            JOIN resources t2
                ON t1.item_id=t2.id
                AND t1.item_name=:item_name
            WHERE t1.group_name=:group_name
            AND t1.group_id=:group_id";
        $resultado = $this->db->run($sql, array('group_name' => , 'group_id' => , 'item_name' => , 'item_id' => ));
        return $resultado;
    }

    public function addTerm() {
        $sql = "INSERT INTO groups_items_relationships (group_name, group_id, item_name, item_id) 
            VALUES (:group_name, :group_id, :item_name, :item_id)";
        $resultado = $this->db->run($sql, array('group_name' => , 'group_id' => , 'item_name' => , 'item_id' => ));
        return $resultado;
    }

    public function removeTerm() {
        $sql = "DELETE FROM groups_items_relationships WHERE ";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function getTerms() {
        $sql = "SELECT FROM groups_items_relationships t1
            JOIN resources t2
                ON t1.item_id=t2.id
                AND t1.item_name=:item_name
            WHERE t1.group_name=:group_name
            AND t1.group_id=:group_id";
        $resultado = $this->db->run($sql, array('group_name' => , 'group_id' => , 'item_name' => , 'item_id' => ));
        return $resultado;
    }
}


<?php

namespace Maltz\Content\Model;

trait ItemRelationships
{

    public function add($id, $item_name, $item_id, $order)
    {
        $bind = array('group_name' => $this->slug, 'group_id' => $id, 'item_name' => $item_name, 'item_id' => $item_id, 'order' => $order);
        $sql = "INSERT INTO groups_items_relationships (group_name, group_id, item_name, item_id, order) VALUES (:group_name, :group_id, :item_name, :item_id, :order)";
        $resultado = $this->db->run($sql, $bind);
        return $resultado;
    }

    public function remove($id, $item_name, $item_id)
    {
        $bind = array('group_name' => $this->slug, 'group_id' => $id, 'item_name' => $item_name, 'item_id' => $item_id);
        $sql = "DELETE FROM groups_items_relationships WHERE group_name=:group_name, group_id=:group_id, item_name=:item_name, item_id=:item_id";
        $resultado = $this->db->run($sql, $bind);
        return $resultado;
    }

    public function removeAll($id, $item_name)
    {
        $bind = array('group_name' => $this->slug, 'group_id' => $id, 'item_name' => $item_name);
        $sql = "DELETE FROM groups_items_relationships WHERE group_name=:group_name, group_id=:group_id, item_name=:item_name";
        $resultado = $this->db->run($sql, $bind);
        return $resultado;
    }

    public function getAll($id, $item_name)
    {
        $fields = 't2.id AS id, '
        switch ($item_name) {
            case 'content':
                $fields .= '';
                break;
            case 'collection':
                $fields .= '';
                break;
            case 'resource':
                $fields .= '';
                break;
            case 'term':
                $fields .= '';
                break;
        }
        $fields .= 't3.title AS title, t3.subtitle AS subtitle, t3.excerpt AS excerpt, t3.description AS description, t3.body AS body, t4.name AS type';

        $item_table = $item_name . 's';
        $bind = array('group_name' => $this->slug, 'group_id' => $id, 'item_name' => $item_name);
        $sql = "SELECT $fields
        FROM groups_items_relationships t1
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

    public function addContent($id, $item_id, $order) {
        return $this->add($id, 'content', $item_id, $order);
    }

    public function removeContent($id, $item_id) {
        return $this->remove($id, 'content', $item_id);
    }

    public function removeAllContents($id) {
        return $this->removeAll($id, 'content');
    }

    public function getAllContents($id) {
        return $this->getAll($id, 'content');
    }

    public function addResource($id, $item_id, $order) {
        return $this->add($id, 'resource', $item_id, $order);
    }

    public function removeResource($id, $item_id) {
        return $this->remove($id, 'resource', $item_id);
    }

    public function removeAllResources($id) {
        return $this->removeAll($id, 'resource');
    }

    public function getAllResources($id) {
        return $this->getAll($id, 'resource');
    }

    public function addCollection($id, $item_id, $order) {
        return $this->add($id, 'collection', $item_id, $order);
    }

    public function removeCollection($id, $item_id) {
        return $this->remove($id, 'collection', $item_id);
    }

    public function removeAllCollections($id) {
        return $this->removeAll($id, 'collection');
    }

    public function getAllCollections($id) {
        return $this->getAll($id, 'collection');
    }

    public function addTerm($id, $item_id, $order) {
        return $this->add($id, 'term', $item_id, $order);
    }

    public function removeTerm($id, $item_id) {
        return $this->remove($id, 'term', $item_id);
    }

    public function removeAllTerms($id) {
        return $this->removeAll($id, 'term');
    }

    public function getAllTerms() {
        return $this->getAll($id, 'term');
    }
}


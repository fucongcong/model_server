<?php
namespace src\Model\Special\Impl;

use src\Model\Special\SpecialModel;
use Model;

class SpecialModelImpl extends Model implements SpecialModel
{
    protected $tableName = 'special';

    protected $types = [
        0 => 'cos',
        1 => 'group',
        2 => 'group_post',
        3 => 'user',
        4 => 'illust',
        5 => 'novel',
        6 => 'shop'
    ];

    public function addSpecial($special) {
        $id = $this -> data($special) -> add();

        foreach ($this-> types as $key => $type) {

            if (in_array($type, $special['type'])) {

                D('Special.SpecialType') -> addSpecialType($id, $key);
            }

        }

        if ($id > 0) {

            $this -> getSpecialCache($id, false);
        }

        return $id;
    }

    public function getSpecial($id) {
        return $this -> where(array('special_id' => $id)) -> limit(1) -> find();
    }

    public function updateSpecial($id, $fields) {

        if ($this -> data($fields) -> where(array('special_id' => $id)) -> limit(1) -> save()) {

            D('Special.SpecialType') -> deleteType($id);

            foreach ($this-> types as $key => $type) {

                if (in_array($type, $fields['type'])) {

                    D('Special.SpecialType') -> addSpecialType($id, $key);
                }

            }

            $this -> getSpecialCache($id, false);
        }

        return $id;
    }

    public function deleteSpecial($id) {
        $status = $this -> data(array('is_del' => 1)) -> where(array('special_id' => $id)) -> limit(1) -> save();
        S('special_cache_all_'.$id,null);

        //清除专题的类型数据
        D('Special.SpecialType') -> deleteType($id);

        return $status;
    }

    public function findSpecials($condition, $orderBy, $start, $limit) {
        $limit = (int) $limit;
        $start = (int) $start;

        $types = $this -> types;
        $types = array_flip($types);
        $pre = C('DB_PREFIX');
        $condition['is_del'] = 0;

        if (isset($condition['type']) && isset($types[$condition['type']])) {

            $type_id = $types[$condition['type']];

            $results = M('SpecialType') -> field('special_id') -> where(array('type_id' => $type_id)) -> order('special_id desc') -> limit("{$start},{$limit}") -> select();

        }else {

            if ($orderBy == "ctime") $orderBy = "ctime desc";

            $results = $this -> field('special_id') -> where($condition) -> order($orderBy) -> limit("{$start},{$limit}") -> select();
        }

        foreach ($results as $key => $data) {

            $special = $this -> getSpecialCache($data['special_id']);
            $specials[$key] = $special;

        }

        return $specials ? : array();
    }

    public function getSpecialsCount($condition) {

        $types = $this -> types;
        $types = array_flip($types);
        $pre = C('DB_PREFIX');
        $condition['is_del'] = 0;

        if (isset($condition['type']) && isset($types[$condition['type']])) {

            $type_id = $types[$condition['type']];

            $count = M('SpecialType') -> field('special_id') -> where(array('type_id' => $type_id)) -> count();

            return $count;

        }else {

            $results = $this -> field('special_id') -> where($condition) -> count();
        }

        return $results;


    }


    public function findSpecialsByType($type, $limit = 5) {

        $types = $this -> types;
        $types = array_flip($types);
        $limit = (int) $limit;
        $pre = C('DB_PREFIX');

        if (isset($types[$type])) {

            $type_id = $types[$type];

            $results = M('SpecialType') -> field('special_id') -> where(array('type_id' => $type_id)) -> order('special_id desc') -> limit("0,{$limit}") -> select();
        }

        foreach ($results as $key => $data) {

            $special = $this -> getSpecialCache($data['special_id']);
            $specials[$key] = $special;
        }

        return $specials ? : array();
    }

    public function findGroupSpecials(array $type, $limit = 5) {

        $types = $this -> types;
        $types = array_flip($types);
        $limit = (int) $limit;
        $pre = C('DB_PREFIX');

        $type_ids = [];
        foreach ($type as $val) {
            if(isset($types[$val])) {
                $type_ids[] = $types[$val];
            }
        }

        if (is_array($type_ids) && count($type_ids) > 0) {

            $type_ids = implode(',', $type_ids);

            $results = M('SpecialType') -> field('special_id') -> where(array('type_id' => array('in', $type_ids))) -> order('special_id desc') -> limit("0,{$limit}") -> select();

        }

        foreach ($results as $key => $data) {

            $special = $this -> getSpecialCache($data['special_id']);
            $specials[$key] = $special;

        }

        return $specials ? : array();
    }

    public function getSpecialCache($id, $use_cache = true) {

        if ($use_cache){

            $special_data = S('special_cache_all_'.$id);

        }

        if (!$special_data){

            $special_data = $this -> where( array( 'special_id' => $id, 'is_del' => 0 ) ) -> find();

            $typeIds = D('Special.SpecialType') -> getTypesById($id);
            if (is_array($typeIds) && count($typeIds) > 0) {
                foreach ($typeIds as $key => $typeId) {
                    $types = $this -> types;
                    $type[] = $types[$typeId['type_id']];
                }

                $special_data['labels'] = $type;
            }

            if (!$special_data){

                return array();
            }

            S('special_cache_all_'.$id,$special_data,24*3600);
        }

        return $special_data;
    }
}

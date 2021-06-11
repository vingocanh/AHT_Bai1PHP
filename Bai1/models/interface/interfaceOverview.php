<?php
interface interfaceOverview{
    public function getList(); 
    public function getListById($values);
    public function getCustomer($values);
    public function add($values);
    public function edit($values);
    public function delete($values);
}

?>
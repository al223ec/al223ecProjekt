<?php

namespace core\db;

interface IRepository{

	public function delete($id);
	public function update($object);
	public function save($object);
}
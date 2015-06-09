<?php

class TablePresenter extends BasePresenter
{
        public function actionDefault($table){
		$dataGrid = new DataGrid();
		$dataGrid->bindDataTable($this->model->getDataSource($table));
                $this->addComponent($dataGrid, 'dg');
		$this->template->canonical = empty($list) ? NULL : $this->link('this', array('order' => NULL));
		$this->template->table = $table;
                $this->template->dataGrid = $dataGrid;
        }
        
}

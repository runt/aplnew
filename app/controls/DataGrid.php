<?php



class DataGrid extends Control
{
	public $page = 1;
	public $order = '';

        public static function getPersistentParams(){
            return array('page','order');
        }


	/** @var int */
	public $rowsPerPage = 15;

	/** @var DibiDataSource */
	protected $dataSource;

	/** @var Paginator */
	protected $paginator;



	public function __construct()
	{
		parent::__construct();

		$this->paginator = new Paginator();
		$this->paginator->itemsPerPage = $this->rowsPerPage;
	}



	public function bindDataTable(DibiDataSource $dataSource)
	{
		$this->dataSource = $dataSource;
		$this->paginator->itemCount = count($dataSource);
	}



	/********************* paginator ****************d*g**/



	/**
	 * Changes page number.
	 */
	public function handlePage($page)
	{
		// $this->page = $page; - is done automatically
	}



	/**
	 * Renders paginator.
	 */
	public function renderPaginator()
	{
		if ($this->paginator->pageCount < 2) return;

		$this->paginator->page = $this->page;

		// paginator steps
		$arr = range(max($this->paginator->firstPage, $this->paginator->page - 3), min($this->paginator->lastPage, $this->paginator->page + 3));
		$count = 4;
		$quotient = ($this->paginator->pageCount - 1) / $count;
		for ($i = 0; $i <= $count; $i++) {
			$arr[] = round($quotient * $i) + $this->paginator->firstPage;
		}
		sort($arr);

		// render
		$template = $this->createTemplate();
                $template->registerFilter('Nette\Templates\CurlyBracketsFilter::invoke');
		$template->paginator = $this->paginator;
		$template->setFile(dirname(__FILE__) . '/paginator.phtml');
		$template->steps = array_values(array_unique($arr));
		$template->render();
	}



	/********************* table grid ****************d*g**/



	/**
	 * Changes column sorting order.
	 */
	public function handleOrder($by)
	{
		parse_str($this->order, $list);

		if (!isset($list[$by])) {
			$list[$by] = 'a';
		} elseif ($list[$by] === 'd') {
			unset($list[$by]);
		} else {
			$list[$by] = 'd';
		}

		$this->order = http_build_query($list, '', '&');
	}



	/**
	 * Renders table grid.
	 */
	public function renderGrid()
	{
		$dataSource = $this->dataSource;

		// paging
		$this->paginator->page = $this->page;
		$dataSource->applyLimit($this->paginator->length, $this->paginator->offset);

		// sorting
		$i = 1;
		parse_str($this->order, $list);
		foreach ($list as $field => $dir) {
			$dataSource->orderBy($field, $dir === 'a' ? dibi::ASC : dibi::DESC);
			$list[$field] = array($dir, $i++);
		}

		// render
		$template = $this->createTemplate();
                $template->registerFilter('Nette\Templates\CurlyBracketsFilter::invoke');
		$template->rows = $dataSource->getIterator();
		$template->columns = $dataSource->getResult()->getColumnNames();
		$template->order = $list;
		$template->setFile(dirname(__FILE__) . '/grid.phtml');
		$template->render();
	}

}

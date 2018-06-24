<?php

namespace Jikan\Helper;

class Episodes extends \Jikan\Abstracts\Helper
{

	public function __construct($page) {
		if (!is_null($page)) {
			$this->setPage($page);
		}
	}

	public function setPage(int $page) {
		$this->offsetSet('p', $page);
	}

	public function build() {
		$query = "";
		foreach ($this->container as $key => $value) {
			$query .= $key . "=" . $value . "&";
		}

		return $query;
	}
}
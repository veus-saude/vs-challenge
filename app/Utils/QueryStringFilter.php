<?php

namespace App\Utils;

class QueryStringFilter {
    private $q = '';
    private $filter = [];
    private $limit = 10;
    private $offset = 0;
    private $sort = [];

    public function __construct ($params) {
        if (isset( $params['q']      )) $this->setQuery  ($params['q']      );
        if (isset( $params['filter'] )) $this->setFilter ($params['filter'] );
        if (isset( $params['limit']  )) $this->setLimit  ($params['limit']  );
        if (isset( $params['offset'] )) $this->setOffset ($params['offset'] );
        if (isset( $params['sort']   )) $this->setSort   ($params['sort']   );
    }

    public function build($query) {
        $query->where('name', 'like', '%'.$this->q.'%');
        foreach ($this->filter as $k=>$v)
          $query->where($k, '=', $v);

        if (!empty($this->sort)) {
          foreach ($this->sort as $sortEl)
            $query->orderBy($sortEl[0], $sortEl[1]);
        }

        $query->skip($this->offset);
        $query->take($this->limit);

        return $query;
    }

    private function setQuery($value) {
        if (!is_string($value)) return;
        $this->q = $value;
    }

    private function setFilter($value) {
        if (!is_string($value)) return;
        $parts = explode(';', $value);

        $this->filter = [];
        foreach ($parts as $part) {
            $filterEl = explode(':', $part);
            if (count($filterEl) == 2) $this->filter[$filterEl[0]] = $filterEl[1];
        }
    }

    private function setLimit($value) {
        $check = filter_var($value, FILTER_VALIDATE_INT);
        if (!$check) return;
        $this->limit = $check;
    }

    private function setOffset($value) {
        $check = filter_var($value, FILTER_VALIDATE_INT);
        if (!$check) return;
        $this->offset = $check;
    }

    private function setSort($value) {
        if (!is_string($value)) return;
        $parts = explode(';', $value);

        $this->sort = [];
        foreach ($parts as $part) {
            $sortEl = explode(':', $part);
            if (count($sortEl) == 2) $this->sort[] = [$sortEl[0], $sortEl[1]];
            elseif (count($sortEl) == 1) $this->sort[] = [$sortEl[0], 'asc'];
        }
    }
}

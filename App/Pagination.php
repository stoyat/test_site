<?php

namespace App;

class Pagination
{
    private $max = 10;
    private $total;
    private $limit;


    /**
     * Pagination constructor.
     * @param $total
     * @param $currentPage
     * @param $limit
     */
    public function __construct($total, $currentPage, $limit)
    {
        $this->total = $total;
        $this->limit = $limit;
        //count page
        $this->amount = $this->amount();
        $this->setCurrentPage($currentPage);
    }

    /**
     * HTML with navig. link
     * @return string
     */
    public function get()
    {
        $links = null;
        $limits = $this->limits();

        $html = '<ul class="pagination">';
        //link generate
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            if ($page == $this->current_page) {
                $links .= '<li class="active"><a href="#">' . $page . '</a></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }
        //if generate
        if (!is_null($links)) {
            # Если текущая страница не первая
            if ($this->current_page > 1) {
                $links = $this->generateHtml(1, '&lt;') . $links;
            }
            if ($this->current_page < $this->amount) {
                $links .= $this->generateHtml($this->amount, '&gt;');
            }
        }
        $html .= $links . '</ul>';
        return $html;
    }

    /**
     * @param $page
     * @param null $text
     * @return string
     */
    private function generateHtml($page, $text = null)
    {
        if (!$text) {
            $text = $page;
        }
        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $currentURI = preg_replace('~/[0-9]+~', '', $currentURI);
        return
            '<li><a href="' . $currentURI . $page . '">' . $text . '</a></li>';
    }

    /**
     * @return array - start and end counter
     */
    private function limits()
    {
        $left = $this->current_page - round($this->max / 2);
        $start = $left > 0 ? $left : 1;

        if ($start + $this->max <= $this->amount) {
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            $end = $this->amount;
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }
        return [$start, $end];
    }

    /**
     * @param $currentPage
     */
    private function setCurrentPage($currentPage)
    {
        $this->current_page = $currentPage;
        if ($this->current_page > 0) {

            if ($this->current_page > $this->amount) {
                $this->current_page = $this->amount;
            }
        } else
            $this->current_page = 1;
    }

    /**
     * @return float
     */
    private function amount()
    {
        return ceil($this->total / $this->limit);
    }
}
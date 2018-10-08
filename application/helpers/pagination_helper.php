<?php

function pagination_page($page)
{
	return (ctype_digit($page) && $page) ? $page : 1;
}

function pagination_offset($page, $limit)
{
	return (pagination_page($page) -1) * $limit;
}

function pagination($p=1, $url, $num_page, $num_record, $click='href', $extra='')
{
	$str = '<div class="pagination">';
	if($num_page > 1){
		$pnumber = '';
		if($p > 1){
			$previous = ($p -1);
			$str .= '<a '.$click.'="'.$url.$previous.$extra.'" title="Next">&laquo;</a> ';
		}
		if($p > 3) $str .= '<a '.$click.'="'.$url.'1'.$extra.'">1</a> ';
		for($i=($p -2); $i < $p; $i++){
		  if($i < 1) continue;
		  $pnumber .= '<a '.$click.'="'.$url.$i.$extra.'">'.$i.'</a> ';
		}
		$pnumber .= ' <a class="active">'.$p.'</a> ';
		for($i=($p +1); $i < ($p +3); $i++){
		  if($i > $num_page) break;
		  $pnumber .= '<a '.$click.'="'.$url.$i.$extra.'">'.$i.'</a> ';
		}
		$pnumber .= (($p +2) < $num_page ? ' <a '.$click.'="'.$url.$num_page.$extra.'">'.$num_page.'</a> ' : " ");
		$str .= $pnumber;
		if($p < $num_page){
			$next = ($p +1);
			$str .= '<a '.$click.'="'.$url.$next.$extra.'" title="Previous">&raquo;</a>';
		}
	}
	$str .= '<span>Total: <b>'.$num_record.'</b> data</span>';
	$str .= '</div>';
	return $str ;
}
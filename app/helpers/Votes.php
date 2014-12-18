<?php 
class Votes {
	
	public static function post_hover_button($post, $element, $value, $class){
		$html="";
		if (isset($post[$element]))
			$html .='<input '.$post[$element].' type="submit" value="'.$value.'" class="'.$class.'-button"/> ';
			return $html;
	}

	public static function post_disabled_button($post, $element, $value, $class){
		$html="";
		if (isset($post[$element]))
			$html .='<input '.$post[$element].' type="submit" value="'.$value.'" class="'.$class.'-disabled" disabled="disabled"/> ';
		return $html;
	}
		

	public static function vote_buttons($post)
		{
			$vote_html="";
			$vote_html .='<div class="qa-vote-buttons '.(($post['vote_view']=='updown') ? 'qa-vote-buttons-updown' : 'qa-vote-buttons-net').'">';

			switch (@$post['vote_state'])
			{
				case 'voted_up':
					$vote_html .= Votes::post_hover_button($post, 'vote_up_tags', '+', 'qa-vote-one-button qa-voted-up');
					break;
					
				case 'voted_up_disabled':
					$this->post_disabled_button($post, 'vote_up_tags', '+', 'qa-vote-one-button qa-vote-up');
					break;
					
				case 'voted_down':
					$vote_html .= Votes::post_hover_button($post, 'vote_down_tags', '&ndash;', 'qa-vote-one-button qa-voted-down');
					break;
					
				case 'voted_down_disabled':
					$this->post_disabled_button($post, 'vote_down_tags', '&ndash;', 'qa-vote-one-button qa-vote-down');
					break;
					
				case 'up_only':
					$this->post_hover_button($post, 'vote_up_tags', '+', 'qa-vote-first-button qa-vote-up');
					$this->post_disabled_button($post, 'vote_down_tags', '', 'qa-vote-second-button qa-vote-down');
					break;
				
				case 'enabled':
					$vote_html .= Votes::post_hover_button($post, 'vote_up_tags', '+', 'qa-vote-first-button qa-vote-up');
					$vote_html .= Votes::post_hover_button($post, 'vote_down_tags', '&ndash;', 'qa-vote-second-button qa-vote-down');
					break;

				default:
					$vote_html .= Votes::post_disabled_button($post, 'vote_up_tags', '', 'qa-vote-first-button qa-vote-up');
					$vote_html .= Votes::post_disabled_button($post, 'vote_down_tags', '', 'qa-vote-second-button qa-vote-down');
					break;
			}

			$vote_html .= '</div>';
			return $vote_html;
		}
}
<?php 
class SideButtons {

	public static function post_button($element,$title){
		$html="";
		if (isset($element))
			$html .= '<input type="submit" class="qa-form-light-button qa-form-light-button-'.$element.'" value="'.$element.'" '.$title.'>';
			//$html .='<input '.$post[$element].' type="submit" value="'.$value.'" class="'.$class.'-button"/> ';
			return $html;
	}
        
        public static function ask_related_button($postid){
            $html="";
            $ask="/ask/follow/";
            if (isset($postid))
                $html .= '<a href="'.URL::to($ask.$postid).'" class="qa-form-light-button qa-form-light-button-follow" title="Ask a new question relating to this answer" name="related_question">ask related question</a>';
                    //$html .= '<input type="submit" class="qa-form-light-button qa-form-light-button-'.$element.'" value="'.$element.'" '.$title.'>';
                    //$html .='<input '.$post[$element].' type="submit" value="'.$value.'" class="'.$class.'-button"/> ';
                return $html;
	}
        
    public static function comment_button($postid){
        $html="";
        $url="c$postid";
        $html .= '<input type="submit" class="qa-form-light-button qa-form-light-button-comment" title="Add a comment on this answer" value="comment" onclick="return qa_toggle_element('."'$url'".')" >';
        return $html;
    }

	public static function getButtons($post){
		$button_html="";
		$button_html .= '<div class="qa-q-view-buttons">';
		$anew="'anew'";
               
		switch (@$post['button_state'])
		{
			case 'without_login_question':
				$button_html .= SideButtons::post_button('flag','title="Flag this question as spam or inappropriate" name="flag"');
				$button_html .= SideButtons::post_button('answer','title="Answer this question" onclick="return qa_toggle_element('.$anew.')"');
				break;
                        
            case 'unflag_login_other_question':
				$button_html .= SideButtons::post_button('unflag','title="Remove the flag that you added" name="unflag"');
				$button_html .= SideButtons::post_button('answer','title="Answer this question" onclick="return qa_toggle_element('.$anew.')"');
				break;
                            
            case 'unflag_login_other_answer' :
                $button_html .= SideButtons::post_button('unflag','title="Remove the flag that you added" name="unflag"');
                $button_html .= SideButtons::ask_related_button($post['postid']);
                if(Setting::qa_opt('comment_on_as'))
                	$button_html .= SideButtons::comment_button($post['postid']);
                break;
                        
            case 'flag_login_other_answer' :
                $button_html .= SideButtons::post_button('flag','title="Flag this question as spam or inappropriate" name="flag"');
                $button_html .= SideButtons::ask_related_button($post['postid']);
                if(Setting::qa_opt('comment_on_as'))
                	$button_html .= SideButtons::comment_button($post['postid']);
                break;
                            
            case 'flag_login_other_question':
				$button_html .= SideButtons::post_button('flag','title="Flag this question as spam or inappropriate" name="flag"');
				$button_html .= SideButtons::post_button('answer','title="Answer this question" onclick="return qa_toggle_element('.$anew.')"');
				break;
			
			case 'self_login_question':
				$button_html .= SideButtons::post_button('edit','title="Edit this question" name="edit"');
				$button_html .= SideButtons::post_button('close','title="Close this question to any new answers"');
				$button_html .= SideButtons::post_button('hide','title="Hide this question"');
				$button_html .= SideButtons::post_button('answer','title="Answer this question" onclick="return qa_toggle_element('.$anew.')"');
				break;
                            
            case 'self_login_answer' :
                // echo "<pre>";print_r($post);die(' rjaa');
                $button_html .= SideButtons::post_button('edit','title="Edit this question" name="edit"');
                $button_html .= SideButtons::post_button('hide','title="Hide this question" name="hide"');
                $button_html .= SideButtons::ask_related_button($post['postid']);
                if(Setting::qa_opt('comment_on_as'))
                	$button_html .= SideButtons::comment_button($post['postid']);
                break;
                        
            case 'reshow' :
                $button_html .= SideButtons::post_button('reshow','title="Reshow this question" name="reshow"');
                break;
                        
			default:
				$button_html .= SideButtons::post_button('flag','title="Flag this question as spam or inappropriate" name="flag"');
				$button_html .= SideButtons::ask_related_button($post['postid']);
				if((Setting::qa_opt('comment_on_as')) || (Setting::qa_opt('comment_on_qs'))) 
                	$button_html .= SideButtons::comment_button($post['postid']);
 				break;
		}
		$button_html .= '</div>';
		return $button_html;
	}
}
?>
<!--
<input class="qa-form-light-button qa-form-light-button-edit" type="submit" title="Edit this question" value="edit" name="q_doedit">

<input class="qa-form-light-button qa-form-light-button-flag" type="submit" title="Flag this question as spam or inappropriate" value="flag" onclick="qa_show_waiting_after(this, false);" name="q_doflag">

<input class="qa-form-light-button qa-form-light-button-close" type="submit" title="Close this question to any new answers" value="close" name="q_doclose">

<input class="qa-form-light-button qa-form-light-button-hide" type="submit" title="Hide this question" value="hide" onclick="qa_show_waiting_after(this, false);" name="q_dohide">

<input id="q_doanswer" class="qa-form-light-button qa-form-light-button-answer" type="submit" title="Answer this question" value="answer" onclick="return qa_toggle_element('anew')" name="q_doanswer">
-->
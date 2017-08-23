<?php
class dynamic_menu{

    function __construct()
    {
        $CI =& get_instance();        
        //$this->load->database();
        $this->db= $CI->load->database('default', TRUE);
    }

    function build_menu()
    {
    $html_out = '';
    $CI =& get_instance();
    $menu = array();
    $tampung = array();

    $group =  $CI->session->userdata('cs_Idgroup_usr');
    $parent ='1'; //$CI->session->userdata('parent');

	$sq1 = "SELECT a.id_menu,a.title,a.url,a.parent,LENGTH(a.parent) AS par,a.icon,'1' as `show`,is_parent FROM dyn_menu a 
            INNER JOIN role_user b ON a.id_menu=b.id_menu 
            WHERE LEFT(parent,1)='$parent' and parent <> '0' and id_group = '$group' AND b.isActive='1' ORDER BY b.id_menu "; 
	
    $sq = "$sq1"; 
	$x = 1;
	$query=$this->db->query($sq);
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
				$tampung[$x]            = $row->id_menu;
				$x = $x+1;
				
                $menu[$row->id_menu]['id']      = $row->id_menu;
                $menu[$row->id_menu]['title']   = $row->title;
                $menu[$row->id_menu]['parent']  = $row->parent;
                $menu[$row->id_menu]['is_parent']  = $row->parent;
                $menu[$row->id_menu]['url']     = $row->url;
                $menu[$row->id_menu]['icon']    = $row->icon;
                $menu[$row->id_menu]['show']    = $row->show;
                $menu[$row->id_menu]['par']    = $row->par;
            }
        }
        $query->free_result(); 
       $html_out .= "\t\t".'<ul >' . "\n";

		$x = 1;
	   for ($a = 1; $a <= count($menu); $a++)
        {
		$xid = $tampung[$a];
		//echo "<br />====================================>$xid<br />";
			if (is_array($menu[$xid]))    // must be by construction but let's keep the errors home
            {
                
                if ($menu[$xid]['par'] == 1)    // are we allowed to see this menu?
                {
					if ($menu[$xid]['is_parent'] == 1)
                    {
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= '<li title="'.$menu[$xid]['title'].'">
                                        <a href="'.base_url().$menu[$xid]['url'].' " onclick="sidebarAktif()">
                                            <span class="menu_icon"><i class="material-icons">'.$menu[$xid]['icon'].'</i></span>
                                            <span class="menu_title">'.$menu[$xid]['title'].'</span>    
                                        </a>';
                    }
                    else
                    {
                       // $html_out .= "\t\t\t\t".'<li>'.anchor($menu[$xid]['url'], '<i class="'.$menu[$xid]['icon'].'"></i> <span class="menu-text">'.$menu[$xid]['title'].'</span>');
                        $html_out .= '<li title="'.$menu[$xid]['title'].'">
                                        <a href="'.base_url().$menu[$xid]['url'].' " onclick="sidebarAktif()">
                                            <span class="menu_icon"><i class="material-icons">'.$menu[$xid]['icon'].'</i></span>
                                            <span class="menu_title">'.$menu[$xid]['title'].'</span>
                                        </a>';
                    }

                    // loop through and build all the child submenus.
                    $html_out .= $this->get_childs($menu, $xid, $tampung);

                    $html_out .= '</li>'."\n";
                }
            }
            else
            {
                exit (sprintf('menu nr %s must be an array', $xid));
            }
		}

        $html_out .= "\t\t".'</ul>' . "\n";
        $html_out .= '';//"\t".'</div>' . "\n";
        return $html_out;
} 
    
     // --------------------------------------------------------------------

    /**
     * get_childs($menu, $parent_id) - SEE Above Method.
     *
     * Description:
     *
     * Builds all child submenus using a recurse method call.
     *
     * @param    mixed    $menu    array()
     * @param    string    $parent_id    id of parent calling this method.
     * @return    mixed    $html_out if has subcats else FALSE
     */
    function get_childs($menu, $parent_id, $tampung)
    {
	   		//print_r($tampung);

	   
	    $has_subcats = FALSE;
        $nu=0;
        $html_out  = '';
        $html_out .= '';//"\n\t\t\t\t".'<div>'."\n";
        $html_out .= "\t\t\t\t\t".'<ul>'."\n";

		for ($a = 1; $a <= count($menu); $a++)
        {
		$xid = $tampung[$a];
		
            if ($menu[$xid ]['parent'] == $parent_id)    // are we allowed to see this menu?
            {
                $has_subcats = TRUE;

                if ($menu[$xid ]['is_parent'] == 1)
                {
                    $html_out .= "\t\t\t\t\t\t".'<li><a href="#">'.$menu[$xid]['title'].'</a>';
                }
                else
                {
                    $nu++;
                    $html_out .= "\t\t\t\t\t\t".'<li><a href="'.base_url().$menu[$xid]['url'].'" onclick="sidebarAktif()">'.$nu.'. '.$menu[$xid]['title'].'</a>';                    
                }

                // Recurse call to get more child submenus.
                $html_out .= $this->get_childs($menu, $xid , $tampung);

                $html_out .= '</li>' . "\n";
            }
        }

        $html_out .= "\t\t\t\t\t".'</ul>' . "\n";
        $html_out .= '';//"\t\t\t\t".'</div>' . "\n";

        return ($has_subcats) ? $html_out : FALSE;
}
    
    
function build_menu_head()
    {
    $html_out = '';
    $CI =& get_instance();
    $menu = array();
    $tampung = array();

    $group = $CI->session->userdata('cs_Idgroup_usr');

	$sq1 = "SELECT a.id_menu,a.title,a.url,a.parent,LENGTH(a.parent) AS par,a.icon,'1' as `show`,is_parent FROM dyn_menu a INNER JOIN role_user b ON a.id_menu=b.id_menu 
    WHERE parent = '0' and id_group = '$group' ORDER BY id_menu "; 
	
  	
    $sq = "$sq1"; 

	$x = 1;
	$query=$this->db->query($sq);
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
				$tampung[$x]            = $row->id_menu;
				$x = $x+1;
				
                $menu[$row->id_menu]['id']      = $row->id_menu;
                $menu[$row->id_menu]['title']   = $row->title;
                $menu[$row->id_menu]['parent']  = $row->parent;
                $menu[$row->id_menu]['is_parent']  = $row->parent;
                $menu[$row->id_menu]['url']     = $row->url;
                $menu[$row->id_menu]['icon']    = $row->icon;
                $menu[$row->id_menu]['show']    = $row->show;
                $menu[$row->id_menu]['par']    = $row->par;
            }
        }
        $query->free_result(); 

      // $html_out .= "\t\t".'<ul >' . "\n";


		$x = 1;
	   for ($a = 1; $a <= count($menu); $a++)
        {
		$xid = $tampung[$a];
		//echo "<br />====================================>$xid<br />";
			if (is_array($menu[$xid]))    // must be by construction but let's keep the errors home
            {
                    $html_out .= '<a id="'.$menu[$xid]['title'].'" class="mngrup" href="'.base_url().$menu[$xid]['url'].'/'.$menu[$xid]['id'].'" onclick="setModul(this)">
                                    <div class="box-mn-hdr">
                                     <i class="material-icons md-36 md-color-grey-50">'.$menu[$xid]['icon'].'</i>
                                     <span class="md-color-grey-50 uk-display-block">'.$menu[$xid]['title'].'</span>
                                      </div>  
                                  </a>';
            }
            else
            {
                exit (sprintf('menu nr %s must be an array', $xid));
            }
    //         $html_out .= '</li>' . "\n";
		}

    //    $html_out .= "\t\t".'</ul>' . "\n";
        $html_out .= '';//"\t".'</div>' . "\n";
        return $html_out;
    } 
}
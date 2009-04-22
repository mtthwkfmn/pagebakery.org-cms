<?php

/**
 * Pages Controller
 * 
 * contains all page related actions
 *
 */

class PagesController extends AppController {

    public $helpers = array('Elements');

    public $view = 'Page';
    
    public $theme = 'default';

	/**
	 * display Page using slug
	 *
	 * @param $slug string, contains slug of page
	 */
    function view( $slug = '' ){
        $this->layout = 'default';
        
        if( empty($slug) ) { // render the homepage
            $page = $this->Page->find( 'first', array( 'order' => 'Page.lft ASC' ) );
        } else {
            $page = $this->Page->find( 'first', array( 'conditions' => array( 'Page.slug' => $slug ) ) );
        }
        
        $this->Page->read(null, $page['Page']['id']);

        $this->set(compact('page'));
    }

	/**
	 * get titles of all pages
	 */
	function getPageTitles() {
		$pages = $this->Page->generatetreelist(null, null, null, '--');
		$this->set('pages', $pages);
	}

	/**
	 * savePage action
	 */
	function savePage() {
		if($this->data) {
			if($this->Page->save($this->data)){
				$this->Session->setFlash(__('Page saved', true));
				$this->redirect(array('action' => 'edit', 'admin' => true, $this -> Page -> id));
			}else{
				$this->Session->setFlash(__('Page not saved', true));
			}
		}
	}

	function admin_index() {

	}

	/**
	 * Add Page
	 *
	 * @param $parent_id int, contains integer if has parent_id, null otherwise
	 */
	function admin_add($parent_id = null) {
		$this->set('parent_id', $parent_id);

		// Get pagetitles for parent_id
		$this->getPageTitles();

		$this->savePage();
	}

	/**
	 * Edit Page
	 *
	 * @param $id int, contains id of page to edit 
	 */
	function admin_edit($id = null) {
		$this->savePage();

		if($id) {
			$page = $this->Page->findById($id);
			$this->data = $page;

			// Get pagetitles for parent_id
			$this->getPageTitles();
		}else{
			$this->redirect(array('action' => 'index', 'admin' => true));
		}
	}

	/**
	 * bind Element to Page
	 */
	function admin_bindElement() {

	}

}

?>

<?php
class UsersController extends PagebakeryAppController {
    
    public function pb_index() {
    
    }
    
    public function pb_login() {
        if( !empty($this->data) ) {
            if( $this->Auth->login($this->data) ) {
                $this->redirect(array('controller' => 'pagebakery', 'action' => 'dashboard', 'pb' => true));
            }
        }
        $this->layout = 'login';
    }
    
    public function pb_logout() {
        $this->autoRender = false;
        $this->Auth->logout();
    }
    
    public function pb_edit() {
    
    }
    
}
?>
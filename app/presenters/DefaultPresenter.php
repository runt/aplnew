<?php
class DefaultPresenter extends BasePresenter {

    protected function startup() {
        parent::startup();
    }
    
    public function renderDefault() {
        $security = $this->fillSecClasses('form_personalmenu');
        $this->template->form_id = $security['form_id'];
        $this->template->secclasses = $security['secclasses'];
        $this->template->readonly = $security['readonly'];
    }
}

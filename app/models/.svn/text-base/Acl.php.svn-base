<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Acl
 *
 * @author runt
 */
class Acl extends Permission{

public function __construct() {
        $model = new AclModel();

        foreach($model->getRoles() as $role)
            $this->addRole($role->name, $role->parent_name);

        foreach($model->getResources() as $resource)
            $this->addResource($resource->name);

        foreach($model->getRules() as $rule){
                $this->{$rule->allowed == 'Y' ? 'allow' : 'deny'}($rule->role, $rule->resource == NULL?self::ALL:$rule->resource, $rule->privilege==NULL?self::ALL:$rule->privilege);
        }
    }

}
?>

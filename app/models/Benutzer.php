<?php



/**
 * Benutzer authenticator.
 */
class Benutzer extends Object implements IAuthenticator
{

	/**
	 * Performs an authentication
	 * @param  array
	 * @return void
	 * @throws AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		$username = strtolower($credentials[self::USERNAME]);
		// kvuli heslum, ktera obsahuja mala i velka pismena nebudu prevadet jen na mala
		// 2016-02-29
		//$password = strtolower($credentials[self::PASSWORD]);
		$password = trim($credentials[self::PASSWORD]);

        $apl = new AplModel();
        $row = $apl->getBenutzerRow($username,$password);
        if(!$row){
            throw new AuthenticationException("Benutzer '$username' nicht gefunden",self::IDENTITY_NOT_FOUND);
        }


        unset($row->password);

        //zjistit role pro daneho uzivatele
        $rolesArray = $apl->getRolesArray($username);
        if(count($rolesArray)==0) $rolesArray = NULL;
        $identity = new Identity($row->realname,$rolesArray,$row);
        //Debug::dump($identity);
        return $identity;
	}

}

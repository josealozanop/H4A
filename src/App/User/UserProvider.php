<?php
// app/src/App/User/UserProvider.php
namespace App\User;
 
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\DBAL\Connection;
 
class UserProvider implements UserProviderInterface
{
    private $conn;
 
    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }
 
    public function loadUserByUsername($username)
    {
		//inicio del control de usuarios
        $stmt = $this->conn->executeQuery('SELECT * FROM tutor WHERE mail_tutor = ?', array(strtolower($username)));
        if($stmt->fetch()==null){
			$stmt = $this->conn->executeQuery('SELECT * FROM usuario WHERE mail_usuario = ?', array(strtolower($username)));
			if (!$user = $stmt->fetch()) {
				throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
			}
			return new User($user['mail_usuario'], $user['pass_usuario'], explode(',', $user['roles']), true, true, true, true);
		}
		//inico control de tutores
		$stmt = $this->conn->executeQuery('SELECT * FROM tutor WHERE mail_tutor = ?', array(strtolower($username)));
		if (!$user = $stmt->fetch()) {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }
 
        return new User($user['id_tutor'], $user['mail_tutor'], $user['pass_tutor'], explode(',', $user['roles']), true, true, true, true);
    }
 
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }
 
        return $this->loadUserByUsername($user->getUsername());
    }
 
    public function supportsClass($class)
    {
        return $class === 'Symfony\Component\Security\Core\User\User';
    }
}
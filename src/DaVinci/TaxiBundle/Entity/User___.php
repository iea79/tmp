<?
public $amount = 1;
    public $businessUser = 45;
    public $User = 5;

    function transfer($amount, $businessUser, $User) {

        $usersRepo = $this->getDoctrine()->getRepository();
        $em = $this->getDoctrine()->getManager();
    //тут лучше сделать репо функцию
        $users = $usersRepo->getUserTransfer($businessUser, $User);

        if (count($users) == 2) {
            foreach ($users as $user) {
                $users[$user->getId()] = $user;
            }

            if ($users[$businessUser]->getFakeMoney() >= $amount) {
                $users[$businessUser]->setFakeMoney($users[$businessUser]->getFakeMoney() - $amount);
                $users[$User]->setFakeMoney($users[$User]->getFakeMoney() + $amount);

                $em->persist($users[$businessUser]);
                $em->persist($users[$User]);
                $em->flash();
            } else {
                exit('Не хватает средств');
            }
        } else {
            exit('Не найден один из пользователей');
        }
    return $this;
    }

    /**
     * Set fakeMoney
     * 
     * @param int $fakeMoney
     * @return \DaVinci\TaxiBundle\Entity\User
     */
            public function setFakeMoney($fakeMoney)
            {
                $this->fakeMoney = $fakeMoney;
                return $this;
            }
    
        /**
         * Get fakeMoney
         * 
         * @return int
         */
        public function getFakeMoney()
        {
            return $this->fakeMoney;
        }
?>
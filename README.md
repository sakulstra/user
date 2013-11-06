User
====

cakephp 2.4 user plugin

till now u still have to add in ur appController
public function __construct($request = null,$response = null){
        parent::__construct($request,$response);
        $Event = new CakeEvent(
            'Controller.App.__construct',
            $this,
            $this->components
        );
        $this->getEventManager()->dispatch($Event);
    }
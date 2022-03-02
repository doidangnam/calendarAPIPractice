<?php

class Router {
	// Use presenter to show calendars and events
	private $presenter;

	function __construct(Presenter $presenter) {
		$this->presenter = $presenter;
	}

	function doUserAction() {
		$this->presenter->putMenu();
		// TODO: Doesn't work!
		// if (!isset($_GET['action']))
		// 	return;
		// $this->presenter->$_GET['action']();

		switch ($_GET['action']) {
			case 'putHome':
				$this->presenter->putHome();
				break;
			
			case 'printCalendars':
				$this->presenter->printCalendars();
				break;

			case 'printCalendarContents':
				$this->presenter->printCalendarContents();
				break;
			
			case 'printEventDetails':
				$this->presenter->printEventDetails();
				break;
				
			default:
				$this->presenter->putHome();
				break;
		}
	}

}
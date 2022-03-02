<?php

class Presenter {

	private $businessLogic;

	public function __construct(Logic $logic) {
		$this->businessLogic = $logic;
	}

	function printCalendars() {
		$this->putCalendarListTitle();
		foreach ($this->businessLogic->getCalendars() as $calendar) {
			$this->putCalendarListElement($calendar);
		}
	}

	function printCalendarContents() {
		$this->putCalendarTitle();

		$eventsForCalendar = $this->businessLogic->getEventsForCalendar(htmlspecialchars($_GET['showThisCalendar']));
		foreach ($eventsForCalendar as $event) {
			$this->putEventListElement($event);
		}
	}

	function printEventDetails() {
		$this->putEvent($this->businessLogic->getEventById($_GET['showThisEvent'], $_GET['calendarId']));
	}

	function putHome() {
		print('Google Calendar OOP');
	}

	function putMenu() {
		$this->putLink('?action=putHome', 'Trang chủ');
		$this->putLink('?action=printCalendars', 'Danh sách lịch');
		$this->putLink('?logout', 'Đăng xuất');
		print('<br><br>');
	}

	private function putEvent($event) {
		$this->putTitle('Chi tiết sự kiện: ' . $event['summary']);
		$this->putBlock('Trạng thái của sự kiện: ' . $event['status']);
		$this->putBlock('Tạo lúc ' .
				date('Y-m-d H:m', strtotime($event['created'])) .
				' và sửa gần nhất lúc ' .
				date('Y-m-d H:m', strtotime($event['updated'])) . '.');
		$this->putBlock('Ghi chú, tổng kết <strong>' . $event['summary'] . '</strong>.');
	}

	private function putCalendarTitle() {
		global $client;
		$this->putTitle('Sau đây là danh sách sự kiện cho lịch ' . getCalendar($client, $_GET['showThisCalendar'])['summary'] . ' :');
	}

	private function putCalendarListElement($calendar) {
		$this->putLink('?action=printCalendarContents&showThisCalendar=' . htmlentities($calendar['id']), $calendar['summary']);
		print('<br>');
	}

	private function putCalendarListTitle() {
		$this->putTitle('Đây là danh sách lịch của bạn:');
	}

	private function putEventListElement($event) {
		print('<div style="font-size:10px;color:grey;">' . date('Y-m-d H:m', strtotime($event['created'])));
		$this->putLink('?action=printEventDetails&showThisEvent=' . htmlentities($event['id']) .
				'&calendarId=' . htmlentities($_GET['showThisCalendar']), $event['summary']);
		print('</div>');
		print('<br>');
	}

	private function putLink($href, $text) {
		print(sprintf('<a href="%s" style="font-size:12px;margin-left:10px;">%s</a> | ', $href, $text));
	}

	private function putTitle($text) {
		print(sprintf('<h3 style="font-size:16px;color:green;">%s</h3>', $text));
	}

	private function putBlock($text) {
		print('<div display="block">' . $text . '</div>');
	}
}

?>

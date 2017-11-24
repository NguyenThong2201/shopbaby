<?php

namespace Company\Controller\Plugin;

use Application\Model\PeopleConnectedTable;
use Application\Model\RequestTable;
use Application\Model\RequestLogsTable;
use Application\Model\UserTable;
use Application\Model\ClientTable;
use Application\Model\UserGroupTable;
use Application\Model\ServiceTypesTable;
use Hayylo\LibDatetime;
use Hayylo\RequestCommon;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Form\Element\Select;
use Zend\Form\Form;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class ActionListPlugin extends AbstractPlugin {

	/**
	 *
	 * @return ViewModel
	 */
	function companyAdmin($request, $form) {

		$actionType = 0;
		if ($request->isPost()) {
			$posts = $request->getPost();
			$actionType = $posts->actionType;
		}
		switch ($actionType) {
			case 0 :
				$adapter = $this->getController()->getAdapter();
				$requestLogsTable = new RequestLogsTable($adapter);
				$requestLogs = $requestLogsTable->getListRequestLogByCompanyId($this->getController()->getCompanyId(), TRUE);
				$data = $this->getData($requestLogs);
				break;
			case 1 :
				$adapter = $this->getController()->getAdapter();
				$requestLogsTable = new RequestLogsTable($adapter);
				$requestLogs = $requestLogsTable->getListRequestLogByCompanyId($this->getController()->getCompanyId(), TRUE);
				$data = $this->getData($requestLogs);
				break;
		}

		$clientList = $this->getListClient();
		$userAccess ['add'] = true;
		$servicesTree = $this->getTreeService(NULL);
		$view = new ViewModel(array (
			'actionType' => $actionType,
			'form' => $form,
			'data' => $data,
			'avatarUser' => $this->getAvatarUser(),
			'userAccess' => $userAccess,
			'clientList' => json_encode($clientList),
			'servicesTree' => json_encode($servicesTree)
		));
		$view->setTemplate("company/action-and-alert/list.phtml");
		return $view;
	}

	function companyManager($request, $form) {
		$actionType = 0;
		if ($request->isPost()) {
			$posts = $request->getPost();
			$actionType = $posts->actionType;
		}
		switch ($actionType) {
			case 0 :
				$adapter = $this->getController()->getAdapter();
				$requestLogsTable = new RequestLogsTable($adapter);
				$groups = $this->getController()->getGroupOfUser($this->getController()->getUserId());
				$requestLogs = $requestLogsTable->getListRequestLogByCompanyManager($groups, TRUE);
				$data = $this->getData($requestLogs);
				break;
		}
		$userAccess ['add'] = true;
		$clientList = $this->getListClient();
		$servicesTree = $this->getTreeService(NULL);
		$view = new ViewModel(array (
			'actionType' => $actionType,
			'form' => $form,
			'data' => $data,
			'avatarUser' => $this->getAvatarUser(),
			'userAccess' => $userAccess,
			'clientList' => json_encode($clientList),
			'servicesTree' => json_encode($servicesTree)
		));
		$view->setTemplate("company/action-and-alert/list.phtml");
		return $view;
	}

	function getAvatarUser() {
		return $this->getController()->getDisplayUserInfo($this->getController()->getUserId())->avatar;
	}

	function getData($requestLogs) {
		$data = [];
		if ($requestLogs) {
			foreach ($requestLogs as $item) {
				$status = 1;
				if ($item->shift_id != NULL) {
					if ($item->action_type == REQUEST_LOG_WORKER_APPLIED && $item->shift_status == SHIFT_NEW || $item->action_type == REQUEST_LOG_WORKER_SUBMITED_TIME && $item->shift_status == SHIFT_ACCEPTED || $item->action_type == REQUEST_LOG_WORKER_EDIT_SUBMITED_TIME && $item->shift_status == SHIFT_ACCEPTED) {
						$status = 0;
					}
				} elseif ($item->action_type == REQUEST_LOG_WORKER_APPLIED && $item->request_status == REQUEST_NEW) {
					$status = 0;
				}
				switch ($item->action_type) {
					case REQUEST_LOG_WORKER_APPLIED:
						$message = 'A new worker has confirmed availability for ' . $item->client_name . '’s - ' . $item->skill_type_abbreviation . ': ' . $item->skill_name;
						break;
					case REQUEST_LOG_WORKER_SUBMITED_TIME:
						$message = 'Review Times and Expenses for ' . $item->client_name . '’s - ' . $item->skill_type_abbreviation . ': ' . $item->skill_name . ' shift(s)';
						break;
					case REQUEST_LOG_WORKER_EDIT_SUBMITED_TIME:
						$message = 'Review Times and Expenses for ' . $item->client_name . '’s - ' . $item->skill_type_abbreviation . ': ' . $item->skill_name . ' shift(s)';
						break;
					default:
						$message = '';
						break;
				}
				$formatTimeZone  = LibDatetime::formatDatetime($item->created_date, 'FULL_DATE_TIME', $this->getController()->getTimeZone());
				$data[] =(object) [
					'request_log_id' => $item->request_log_id,
					'request_id' => $item->request_id,
					'shift_id' => $item->shift_id,
					'time' => ( (strtotime(date('Y-m-d', strtotime($item->created_date))) == strtotime(date('Y-m-d'))) ? '<span class="text-green">Today' : '<span>' . LibDatetime::formatDateDisplay($formatTimeZone, 'jS M')) . '</span>',
					'message' => $message,
					'status' => $status
				];
			}
		}
		return json_encode($data);
	}

	function getListClient() {
		$groupIdArr = array ();
		$adapter = $this->getController()->getAdapter();
		$userTable = new UserTable($adapter);
		if ($this->getController()->getUserType() == USER_TYPE_COMPANY_MANAGER) {
			$userGroupTable = new UserGroupTable($adapter);
			$group = $userGroupTable->getGroupByUserId($this->getController()->getUserId());
			foreach ($group as $val) {
				$groupIdArr[] = $val['group_id'];
			}
		}
		$clientTable = new ClientTable($adapter);
		$clientResult = $clientTable->getListByCompanyId($this->getController()->getCompanyId(), NULL, $groupIdArr);
		$clients = array ();

		if ($clientResult) {
			$limit = 5;
			$i = 0;
			foreach ($clientResult as $key => $client) {
				if ($client->active_code != NULL && $client->is_use_hayylo == VALID_FLG_ON && ($client->email != NULL || $client->phone_number != NULL)) {
					continue;
				}
				if ($client->users_family_or_friend) {
					continue;
				}
				$clients[] = [
					'client_user_id' => $client->user_id,
					'avatar' => $client->avatar ? $client->avatar : '/images/user-2-red.png',
					'name' => htmlspecialchars($client->first_name) . " " . htmlspecialchars($client->last_name),
					'address' => htmlspecialchars($client->address . ', ' . $client->suburb),
					'phone' => $client->phone_number,
					'phone' => $client->phone_number,
					'status_shift' => 'Change Shift Date: Fri, 25th Aug toFri,1 Sep 2017'
				];
				if ($i++ && $i >= $limit) {
					break;
				}
			}
		}
		return $clients;
	}

	function getListServiceById(){
		$adapter = $this->getController()->getAdapter();
		$serviceTypeTable = new ServiceTypesTable($adapter);
		$serviceResult = $serviceTypeTable->getListServiceTypesById($this->getController()->getCompanyId(), NULL);
		$services = [];

		if ($serviceResult) {
			foreach ($serviceResult as $key => $serviceType) {
				$services[] = (object)[
					'service_type_id' => $serviceType->service_type_id,
					'parent_id' => $serviceType->parent_id,
					'service_title' => $serviceType->service_title,
					'service_instruction' => $serviceType->service_instruction,
					'option_type' => $serviceType->option_type
				];
			}
		}
		return $services;
	}
	function getTreeService($id){
		$adapter = $this->getController()->getAdapter();
		$serviceTypeTable = new ServiceTypesTable($adapter);
		$serviceResult = $serviceTypeTable->getListServiceTypesById($this->getController()->getCompanyId(), $id);
		$services = [];
		if ($serviceResult) {
			foreach ($serviceResult as $key => $serviceType) {
				$services[] = [
					'service_type_id' => $serviceType->service_type_id,
					'parent_id' => $serviceType->parent_id,
					'service_title' => $serviceType->service_title,
					'service_instruction' => $serviceType->service_instruction,
					'option_type' => $serviceType->option_type,
					'tree' => $this->getTreeService($serviceType->service_type_id)
				];
			}
		}
		return $services;
	}
}
<?php

/*
	* Admin Custom Pages Module v 1.0.5
	* Create custom admin pages without building a Process Module
	*
	* @author Diogo Oliveira
	*
	* @modified kreativan.dev
	*
	* ProcessWire 3.x
	* Copyright (C) 2011 by Ryan Cramer
	* Licensed under GNU/GPL v2, see LICENSE.TXT
	*
	* http://www.processwire.com
	*
*/

class ProcessAdminCustomPages extends Process {

	static public function getModuleInfo() {
		return array(
			'title'   => 'Admin Custom Pages',
			'summary' => __('Create custom admin pages without building a Process Module'),
			'version' => 111,
			'author'  => 'Diogo Oliveira',
			'permission' => 'page-view',
			'installs' => array('FieldtypeAdminCustomPagesSelect'),
			'requires' => array('FieldtypeAdminCustomPagesSelect')
		);
	}

	public function init() {
		parent::init();
	}

	public function ___execute() {

		$template_file = wire('config')->paths->root . $this->page->ACP_template;

		if (file_exists($template_file)) {

			// only works with dev version of ProcessWire May 8 2013
			return $this->page->render($template_file);
		} elseif ($this->page->child->id) {

			// for the current stable version use this method
			// 'include=hidden' added by suggestion of Macrura and kongondo at the forum
			// http://processwire.com/talk/topic/3474-admin-custom-pages-module/?p=38304
			return $this->page->child('include=hidden')->render();
		} else {

			return $this->error(__("You have to assign a template file to this 'Admin Custom Page'."));
		}
	}

	// install method created by Pete (https://github.com/Notanotherdotcom)
	public function ___install() {

		// Check if PW 2.4 or higher is installed
		if (ProcessWire::versionMajor == 2 && ProcessWire::versionMinor < 4) {
			throw new WireException(__("This module requires ProcessWire 2.4 or newer"));
		}


		if ($this->fields->get('ACP_template') == NULL) {
			// If it doesn't exist then carry on and create it
			$field = new Field();
			$field->type = $this->modules->get("FieldtypeAdminCustomPagesSelect");
			$field->name = 'ACP_template';
			$field->label = 'Template';
			$field->description = __('Select the template which should get rendered. Templates have to be in /site/templates/.');
			$field->save();

			// Add field to admin template
			$adminTemplate = $this->templates->get('admin');
			$adminTemplate->fields->add($field);
			$adminTemplate->fields->save();

			$this->message(__("Added field 'ACP_template' to admin."));
		}
	}


	public function ___uninstall() {
		// Remove the select field
		$adminTemplate = $this->templates->get('admin');
		if ($adminTemplate->fields->get('ACP_template')) {
			$adminTemplate->fields->remove($adminTemplate->fields->get('ACP_template'));
			$adminTemplate->fields->save();
		}

		// Remove ACP_template
		if ($this->fields->get('ACP_template')) {
			$field = $this->fields->get('ACP_template');
			$this->fields->delete($field);
		}
	}
}

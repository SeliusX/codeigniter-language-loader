<?php

/**
 * Created by PhpStorm.
 * @author: cwaltjen
 * Date: 31/01/16
 * Time: 13:40
 */
class LanguageLoader
{

  /**
   * @var CI_Controller
   */
  protected $CI;

  /**
   * LanguageLoader constructor.
   */
  public function __construct()
  {
    $this->CI =&get_instance();
    $this->CI->load->library('session');
  }


  /**
   * The hooks function
   */
  public function initialize()
  {
    $userLanguage = $this->detectUserLanguage();
    $this->loadLanguageFiles($userLanguage);
  }

  /**
   * Detects users language
   * 
   * @return string
   */
  protected function detectUserLanguage()
  {
    $language = $this->CI->session->userdata('site_lang');

    if ($language === null)
    {
      $language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
      $this->CI->session->set_userdata('site_lang', $language);
    }
    
    return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
  }

  /**
   * Loading all language files
   * 
   * @param string $language
   */
  protected function loadLanguageFiles($language = 'en')
  {
    $languagePath = APPPATH.DIRECTORY_SEPARATOR.'language'.DIRECTORY_SEPARATOR.$language;

    $dir = new DirectoryIterator($languagePath);
    foreach ($dir as $fileInfo) {
      if ($fileInfo->getExtension() == 'php') {
        $this->CI->lang->load($fileInfo->getBasename(), $language);
      }
    }
  }
}
<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */

namespace CodeIgniter\Core;

use DI\Container;
use Dotenv\Dotenv;

class Application extends Container
{
    /**
     * The CodeIgniter framework version.
     *
     * @var string
     */
    const VERSION = '3.2.0-dev';

    /**
     * Startup the application.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setExceptionHandler();
        $this->loadEnvironmentVariables();
        $this->setSubClassPrefix();
        $this->startTimer();
        $this->instantiateConfiguration();
    }

    /**
     * Register global exception handler.
     *
     * @return void
     */
    protected function setExceptionHandler()
    {
        set_error_handler('_error_handler');
        set_exception_handler('_exception_handler');
        register_shutdown_function('_shutdown_handler');
    }

    /**
     * Capture .env file into $_ENV.
     *
     * @return void
     */
    protected function loadEnvironmentVariables()
    {
        Dotenv::createUnsafeImmutable(BASEPATH . '../')->load();
    }

    /**
     * Set the subclass_prefix.
     * 
     * Normally the "subclass_prefix" is set in the config file.
     * The subclass prefix allows CI to know if a core class is
     * being extended via a library in the local application
     * "libraries" folder. Since CI allows config items to be
     * overridden via data set in the main index.php file,
     * before proceeding we need to know if a subclass_prefix
     * override exists. If so, we will set this value now,
     * before any classes are loaded
     * Note: Since the config file data is cached it doesn't
     * hurt to load it here.
     *
     * @return void
     */
    protected function setSubClassPrefix()
    {
        if ( ! empty($assign_to_config['subclass_prefix']))
        {
            get_config(array('subclass_prefix' => $assign_to_config['subclass_prefix']));
        }
    }

    /**
     * Start the timer... tick tock tick tock...
     *
     * @return vois
     */
    protected function startTimer()
    {
        $benchmark = $this->get(Benchmark::class);
        $benchmark->mark('total_execution_time_start');
        $benchmark->mark('loading_time:_base_classes_start');
    }

    /**
     * Instantiate the config class
     *
     * Note: It is important that Config is loaded first as
     * most other classes depend on it either directly or by
     * depending on another class that uses it.
     *
     * @return void
     */
    protected function instantiateConfiguration()
    {
        $config = $this->get(Config::class);

        // Do we have any manually set config items in the index.php file?
        if (isset($assign_to_config) && is_array($assign_to_config))
        {
            foreach ($assign_to_config as $key => $value)
            {
                $config->set_item($key, $value);
            }
        }
    }
}

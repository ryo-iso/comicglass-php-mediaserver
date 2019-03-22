<?php

class App
{
    const CONFIG_FILE = './config.php';
    const DEFAULT_CONFIG = [
        'allowedExtensionsRegex' => '/\.(zip|rar|pdf|png|jpe?g|gif|tiff?|bmp|cbz|cbr|cgt)$/',
    ];

    const TMPL_ITEM = [
        'type' => 'd', // 'd' = directory, 'f' = file
        'name' => '',
        'modifiedAt' => 0,
        'href' => '',
        'filesize' => 0,
    ];

    protected $config = null;

    protected $rootDir = '';
    protected $path = './';
    protected $list = [];

    /**
     * Create a new App class
     *
     * @return void
     */
    public function __construct()
    {
        $this->config = array_merge(self::DEFAULT_CONFIG, include_once(self::CONFIG_FILE));

        $this->setRootDir();
        $this->setPath();
        $this->loadFileList();
    }

    protected function setRootDir()
    {
        $this->rootDir = dirname($_SERVER['SCRIPT_NAME']);
    }

    public function rootDir()
    {
        return $this->rootDir;
    }

    protected function setPath()
    {
        if (!empty($_GET['path'])) {
            $path = stripcslashes($_GET['path']);
            $realpath = realpath($path);

            // Prevent directory traversal
            if ($realpath !== false && strpos($realpath, realpath('./'), 0) === 0) {
                $this->path = $path;
            }
        }
    }

    public function path()
    {
        return $this->path;
    }

    protected function loadFileList()
    {
        // Get file list
        $dir = dir('' . $this->path);

        while ($item = $dir->read()) {
            // Skip hidden dir/file
            if (substr($item, 0, 1) == '.') {
                continue;
            }

            $type = is_dir($this->path . $item) ? 'd' : 'f';

            if ($type == 'f' && !preg_match($this->config['allowedExtensionsRegex'], $item)) {
                continue;
            }

            $dirPath = str_replace('%2F', '/', rawurlencode($this->path . $item));
            $fullPath = str_replace('./', '', $this->path . $item);

            // Save item
            $listItem = (object) self::TMPL_ITEM;
            $listItem->name = $item;
            $listItem->modifiedAt = filemtime($fullPath);

            if ($type == 'd') {
                $listItem->href = '?path=' . $dirPath . '/';
            } else {
                $listItem->type = $type;
                $listItem->href = $this->rootDir . '/' . str_replace('./', '', $dirPath);
                $listItem->filesize = filesize($fullPath);
            }

            $this->list[] = $listItem;
        }
        $dir->close();
        usort($this->list, [__CLASS__, 'sortList']);
    }

    public function list()
    {
        return $this->list;
    }

    static protected function sortList($a, $b)
    {
        if ($a->type === $b->type) {
            return strnatcmp($a->name, $b->name);
        }

        return strnatcmp($a->type, $b->type);
    }
}

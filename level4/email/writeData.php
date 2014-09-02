<?php

class writeData
{
    /**
     * Записываем данные в файл
     * @param string $file
     * @param string $dataToWrite
     */
    public function write($file, $dataToWrite)
    {
        if ($this->isValidFile($file))
        {
            $handle = fopen($file, 'a');
            fwrite($handle, $dataToWrite);
            fclose($handle);
        }
    }
    
    /**
     * Проверяем файл на существование и доступность
     * @param string $file
     * @return bool
     */
    private function isValidFile($file)
    {
      return file_exists($file) && is_readable($file) && is_writable($file);
    }
}

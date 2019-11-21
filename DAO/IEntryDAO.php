<?php
namespace DAO;

use Models\Entry as Entry;

interface IEntryDAO
{
    function Add(Entry $entry);
    function GetAll();
    function GetEntriesListByFunctionId($id);
}
?>
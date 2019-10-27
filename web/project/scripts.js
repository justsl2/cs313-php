  function deleteRecord(rowid)  
  {   
      var row = document.getElementById(rowid);
      row.parentNode.removeChild(row);
  }
  function deleteRecord(rowid)  
  {   
      alert(rowid)
      var row = document.getElementById(rowid);
      row.parentNode.removeChild(row);
  }
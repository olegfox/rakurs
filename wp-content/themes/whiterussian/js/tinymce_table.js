window.onload = function() {
    var doc = document.getElementById("content_ifr").contentDocument,
        head = doc.head || doc.getElementsByTagName('head')[0],
        style = doc.createElement('style');

    style.type = 'text/css';

    if (style.styleSheet){
        style.styleSheet.cssText = 'table.mce-item-table{border-collapse:collapse;margin-bottom:3em;width:100%;background:#fff;border:2px solid #000}.mce-item-table tr:first-child td,.mce-item-table tr:first-child th,.mce-item-table tr:nth-child(2) td,.mce-item-table tr:nth-child(2) th{text-align:center;text-transform:uppercase;font-size:15px;background-color:#fff;font-weight:700;color:#000;border:1px solid #000}.mce-item-table tr td:first-child,.mce-item-table tr th:first-child{background-color:#75b2eb;text-align:left;text-transform:none;font-size:12px;border:1px solid #000;font-weight:700}.mce-item-table td,.mce-item-table th{padding:.75em 1em;text-align:left;font-size:12px}.mce-item-table th{padding:.75em 1em;text-align:left;border:1px solid #000}.mce-item-table td{border:1px solid #999}.mce-item-table .newssidebar td,.mce-item-table .newssidebar th{padding:.75em .5em;text-align:left}.mce-item-table td.err{background-color:#e992b9;color:#fff;font-size:.75em;text-align:center;line-height:1}.mce-item-table th{background-color:#fff;font-weight:700;color:#000}.mce-item-table tbody th{background-color:#75b2eb}.mce-item-table tbody tr:nth-child(2n-1){background-color:#f5f5f5;transition:all .125s ease-in-out}.mce-item-table tbody tr:hover{background-color:rgba(0,129,204,.3)}.mce-item-table thead th{text-align:center;text-transform:uppercase;font-size:15px}';
    } else {
        style.appendChild(doc.createTextNode('table.mce-item-table{border-collapse:collapse;margin-bottom:3em;width:100%;background:#fff;border:2px solid #000}.mce-item-table tr:first-child td,.mce-item-table tr:first-child th,.mce-item-table tr:nth-child(2) td,.mce-item-table tr:nth-child(2) th{text-align:center;text-transform:uppercase;font-size:15px;background-color:#fff;font-weight:700;color:#000;border:1px solid #000}.mce-item-table tr td:first-child,.mce-item-table tr th:first-child{background-color:#75b2eb;text-align:left;text-transform:none;font-size:12px;border:1px solid #000;font-weight:700}.mce-item-table td,.mce-item-table th{padding:.75em 1em;text-align:left;font-size:12px}.mce-item-table th{padding:.75em 1em;text-align:left;border:1px solid #000}.mce-item-table td{border:1px solid #999}.mce-item-table .newssidebar td,.mce-item-table .newssidebar th{padding:.75em .5em;text-align:left}.mce-item-table td.err{background-color:#e992b9;color:#fff;font-size:.75em;text-align:center;line-height:1}.mce-item-table th{background-color:#fff;font-weight:700;color:#000}.mce-item-table tbody th{background-color:#75b2eb}.mce-item-table tbody tr:nth-child(2n-1){background-color:#f5f5f5;transition:all .125s ease-in-out}.mce-item-table tbody tr:hover{background-color:rgba(0,129,204,.3)}.mce-item-table thead th{text-align:center;text-transform:uppercase;font-size:15px}'));
    }

    head.appendChild(style);
    console.log(doc.head.innerHTML);
};

//(function(){
    //$('#content_ifr').remove();
    //$('iframe').load( function() {
    //    alert("dfgfd");
    //    $('iframe').contents().find("head")
    //        .append($("<style type='text/css'>table.mce-item-table{border-collapse:collapse;margin-bottom:3em;width:100%;background:#fff;border:2px solid #000}.mce-item-table tr:first-child td,.mce-item-table tr:first-child th,.mce-item-table tr:nth-child(2) td,.mce-item-table tr:nth-child(2) th{text-align:center;text-transform:uppercase;font-size:15px;background-color:#fff;font-weight:700;color:#000;border:1px solid #000}.mce-item-table tr td:first-child,.mce-item-table tr th:first-child{background-color:#75b2eb;text-align:left;text-transform:none;font-size:12px;border:1px solid #000;font-weight:700}.mce-item-table td,.mce-item-table th{padding:.75em 1em;text-align:left;font-size:12px}.mce-item-table th{padding:.75em 1em;text-align:left;border:1px solid #000}.mce-item-table td{border:1px solid #999}.mce-item-table .newssidebar td,.mce-item-table .newssidebar th{padding:.75em .5em;text-align:left}.mce-item-table td.err{background-color:#e992b9;color:#fff;font-size:.75em;text-align:center;line-height:1}.mce-item-table th{background-color:#fff;font-weight:700;color:#000}.mce-item-table tbody th{background-color:#75b2eb}.mce-item-table tbody tr:nth-child(2n-1){background-color:#f5f5f5;transition:all .125s ease-in-out}.mce-item-table tbody tr:hover{background-color:rgba(0,129,204,.3)}.mce-item-table thead th{text-align:center;text-transform:uppercase;font-size:15px}</style>"));
    //});
//});

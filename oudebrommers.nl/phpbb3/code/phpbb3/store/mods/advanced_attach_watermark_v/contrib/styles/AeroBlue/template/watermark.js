    // <![CDATA[
    function getMax(anumber, another) {
        return((anumber> another) ? anumber : another);
    }
    function resizeTextArea(t, minRows, minCols) {
        t.rows = minRows;
        t.setAttribute("wrap", "off");
        t.style.overflow = "auto";
        lines = t.value.split("\n");
		
        if (arguments.length> 2) {
            t.cols = minCols;
            maxChars = lines[0].length;
            for(i = 1; i <lines.length; i++) {
                currentLength = lines[i].length;
                if (currentLength> maxChars) maxChars = currentLength;
            }
            t.cols = getMax(maxChars, minCols);
        }
        t.rows = getMax(lines.length + 1, minRows);
    }

      function spoile(id){
       if (document.getElementById) {
        var s = document.getElementById(id);
        s.style.display = (s.style.display=='block'?'none':'block');
        } 
      }
	 // ]]>
/*
 * Function to get an XMLHttpRequest object.  Lightly modified from the code
 * at https://developer.mozilla.org/En/AJAX/Getting_Started.
 */
function GetXmlHttpObject() {
    var httpRequest;

    httpRequest = new XMLHttpRequest();
    if (!httpRequest) {
        alert('Giving up.  Cannot create an XMLHTTP instance.');
    }

    return httpRequest;
}

/*
 * Function to make the actual request, using GET.  Again, copied from
 * Mozilla's code.
 */
function makeRequest(request, url) {
    request.open("GET", url, true);
    request.send();
}

/*
 * Generic function handler.
 */
function handleRequest(fn, urlStr) {
    var request = GetXmlHttpObject();

    // Specify a callback
    request.onreadystatechange = function callback() { fn(request); }

    // Make the request
    makeRequest(request, urlStr);
}

/*
 * Almost-generic function handler, handling request specifically on a
 *   completed response.  Basically, I got sick of retyping the nested
 *   if-statements that check whether the response is complete and OK.
 */
function handleRequestOnCompletion(fn, urlStr) {
    var handlerFn = function handler(req) {
        if (req.readyState === XMLHttpRequest.DONE) { // Response is complete
            if (req.status === 200) {  // HTTP OK (code number is from the HTTP standard)
                fn(req);
            }
        }
    };
    handleRequest(handlerFn, urlStr);
}

/*
 * Fill in text or HTML into the given element from the given URL.
 */
function updateElement(eltID, urlStr) {
    var fillFn = function fillIn(request) {
		var elt = document.getElementById(eltID);
		elt.innerHTML = request.responseText;
    }

    handleRequestOnCompletion(fillFn, urlStr);
}


/*
 * Make and return an element of the given tag type, setting
 * its innerHTML to the given data.  This handles not only table
 * cells (both 'th' and 'td'), but also tags like 'span' and 'p'
 * that commonly contain nothing but text.  (In point of fact,
 * this function could be used to fill in an arbitrary HTML 
 * snippet, but it's probably bad practice to make such big
 * changes to the DOM via the innerHTML property.)
 */
function makeAndFillElt(tagType, data) {
    var elt = document.createElement(tagType);
    elt.innerHTML = data;
    return elt;
}



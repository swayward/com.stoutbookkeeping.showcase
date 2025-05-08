
    document.addEventListener('DOMContentLoaded', function() {
        insert_html();
    });

    // This function will insert the html into the page - Bootstrap v5.3
    function insert_html () {

        const htmlString = `

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" style="position:fixed; top:10px; left:25px; height:45px; width:350px; border-radius:15px; font-size:16px; background-color:green; color:white;" >About This Showcase</button>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">About StoutBookkeeping.com web site.</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <p>This is a rewrite from an earlier version of this site.</p>
                            <h5>Programming</h5>
                            <ul>
                                <li>HTML &amp; CSS: Website basics. I did a lot of CSS to make the site appear the same as before.</li>
                                <li><a href="https://getbootstrap.com">Bootstrap 5.3.3</a>: Bootstrap is a Javascript &amp; CSS framework.</li>
                                <li>PHP: I used PHP on this site to glue parts of the page together. Since the content area is the only part that changes, I import the other parts of the page. It is also used to show which menu item is the active page as well as change the page title.</li>
						    </ul>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
						
		`;
		
		document.body.innerHTML += htmlString;
		
	}

            </div>
          </div>
        </div> <!-- /container -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="https://twemoji.maxcdn.com/2/twemoji.min.js?2.4"></script>
        <script>
        list = document.getElementsByClassName("emoji");

        for (i = 0; i < list.length; i++) {
            list[i].innerHTML = twemoji.parse(list[i].innerHTML);
        }
        </script>
    </body>
</html>

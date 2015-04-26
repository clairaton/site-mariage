</div>
		</main>

		<footer>
			<p><em>Copyright Claire ANSART <?=date('Y')?></em></p>
		</footer>
		<?php if($currentPage == 'panel.php'){?>
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
			<script src="js/jquery.js"></script>
			<script src="js/google.js"></script>
			<script src="js/app.js"></script>
		<?php }
		else {?>
			<script src="js/jquery.js"></script>
			<script src="js/app.js"></script>
			<?php } ?>
	</body>
</html>

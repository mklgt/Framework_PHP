</section>
    </main>
    <footer class="bg-grisClaro border border-start-0 border-end-0 border-3 border-dark text-light p-3 text-center">
        <p>Consulta de Aulas Maria Ana Sanz</p>
        <p class="copyright">
            &copy;
            <?php
            setlocale(LC_TIME, 'Spanish');
            $fecha = strftime("%A, %d  %B %Y");
            echo utf8_encode($fecha);
            ?>
        </p>
    </footer>
    <script src="js/script.js"></script>
</body>

</html>
Función que debes agregar entre las funciones del controlador que quieras hacer paginación!

/**
     * Lists all Turnos entities.
     *
     * @Route("/informe/", name="reserva_turnopar_index_completo")
     * @Route("/informe/{page}")
     * @Method("GET")
     */
    public function indexAction($page = null)
    {
        //$em = $this->getDoctrine()->getManager();
        //$turnoPars = $em->getRepository('AppBundle:TurnoPar')->findAll();
        $turnoPars = $this->getUser()->getTurnos();

        $range = 6; //Cantidad de elementos que quieras mostrar por página
        $pages = count($turnoPars) / $range; //Calcula la cantidad total de páginas
        
        $turnoPars  = $turnoPars->slice($page*$range,$range); //Si es un ArrayCollection() de Doctrine
        //$turnoPars  = array_slice($turnoPars,$page*$range,$range); //Si es un array() de php

        return $this->render('turnopar/indexcompleto.html.twig', array( //plantilla donde quieres colocar el paginador
            'turnoPars' => $turnoPars,
            'range' => $range,
            'pages' => $pages,
            'page'  => $page
        ));
    }


//Debes agregar el html correspondiente donde quieras que aparezca el paginador
 <nav class="text-center">
      <ul class="pagination">
        <li>  
          {% if page > 0 %}  
          <a href="{{ page - 1 }}" aria-label="Previous">
          {% else %}
          <li class="disabled"><a href="#" aria-label="Previous">
          {% endif %}
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        {% for i in 0..pages %}
            {% if i == page %}
            <li class="active"><a href="{{ i }}">{{ i }}</a></li>
            {% else %}
            <li><a href="{{ i }}">{{ i }}</a></li>
            {% endif %}
        {% endfor %}
        <li>
            {% if page < pages-1 %}  
            <a href="{{ page + 1 }}" aria-label="Next">
            {% else %}
            <li class="disabled"><a href="#" aria-label="Next">
            {% endif %}   
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>

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

        $range = 6;
        $pages = count($turnoPars) / $range;
        //die(var_dump($turnoPars));
        $turnoPars  = $turnoPars->slice($page*$range,$range);
        //$turnoPars  = array_slice($turnoPars,$page*$range,$range);

        return $this->render('turnopar/indexcompleto.html.twig', array(
            'turnoPars' => $turnoPars,
            'range' => $range,
            'pages' => $pages,
            'page'  => $page
        ));
    }



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

import React from "react";

const Articles = () => {
  return (
    <section id="main-content">
      <div className="page-title">
        <h3 className="animate__animated animate__fadeIn">PUBLICATIONS</h3>
      </div>
      <div
        className="table-container animate__animated animate__fadeIn"
        id="tbl-container"
      >
        <div className="header">
          <div className="left">
            <h4>DOCUMENTS</h4>
          </div>
          <div className="right">
            <form>
              <div className="form-control" method="GET" action="">
                <input
                  type="text"
                  name="search-table"
                  placeholder="Search Article or Author"
                  defaultValue="<?=isset($_GET['search-table']) ?  $_GET['search-table'] : ''?>"
                />
                <i className="bx bx-search icon" />
              </div>
            </form>
            <div className="sort-btn">
              <button id="btn-sort">
                <i className="bx bx-sort icon" />
                Sort
              </button>
              <ul className="sort-links">
                <li>
                  <a href="<?= sortLink($search_query, 'title', $dateStart_query, $dateEnd_query, $campus_query) ?>">
                    by Title
                  </a>
                </li>
                <li>
                  <a href="<?= sortLink($search_query, 'date', $dateStart_query, $dateEnd_query, $campus_query) ?>">
                    by Date
                  </a>
                </li>
                <li>
                  <a href="<?= sortLink($search_query, 'campus', $dateStart_query, $dateEnd_query, $campus_query) ?>">
                    by Campus
                  </a>
                </li>
              </ul>
            </div>
            <div className="filter-btn">
              <button id="btn-filter">
                <i className="bx bx-filter icon" />
                Filter
              </button>
              <div className="filter-options">
                <form action="">
                  <input
                    type="hidden"
                    name="search-table"
                    defaultValue="<?=$search_query != 'empty_search' ?  $search_query : ''?>"
                  />
                  <input
                    type="hidden"
                    name="sort"
                    defaultValue="<?=$sort_query != 'empty_sort' ?  $sort_query : ''?>"
                  />
                  <p>By Date :</p>
                  <div className="form-control">
                    <label htmlFor="from">From</label>
                    <input
                      type="text"
                      id="to"
                      name="date-start"
                      placeholder="FROM"
                      empty_dstart=""
                    />
                  </div>
                  <div className="form-control">
                    <label htmlFor="to">To</label>
                    <input
                      type="text"
                      id="to"
                      name="date-end"
                      placeholder="TO"
                    />
                  </div>
                  <p>By Campus :</p>
                  <div className="checkbox-filter">
                    <div className="checkbox-control">
                      <input type="checkbox" id="all" />
                      <label htmlFor="all">Select All</label>
                    </div>
                    <div className="checkbox-control">
                      <input
                        type="checkbox"
                        id="alangilan"
                        name="select-campus[]"
                        className="campus-bsu"
                        defaultValue="Alangilan"
                      />
                      <label htmlFor="alangilan">Alangilan</label>
                    </div>
                    <div className="checkbox-control">
                      <input
                        type="checkbox"
                        id="central"
                        name="select-campus[]"
                        className="campus-bsu"
                        defaultValue="Central"
                      />
                      <label htmlFor="central">Central</label>
                    </div>
                    <div className="checkbox-control">
                      <input
                        type="checkbox"
                        id="lipa"
                        name="select-campus[]"
                        className="campus-bsu"
                        defaultValue="Lipa"
                      />
                      <label htmlFor="lipa">Lipa</label>
                    </div>
                    <div className="checkbox-control">
                      <input
                        type="checkbox"
                        id="lobo"
                        name="select-campus[]"
                        className="campus-bsu"
                        defaultValue="Lobo"
                      />
                      <label htmlFor="lobo">Lobo</label>
                    </div>
                    <div className="checkbox-control">
                      <input
                        type="checkbox"
                        id="mabini"
                        name="select-campus[]"
                        className="campus-bsu"
                        defaultValue="Mabini"
                      />
                      <label htmlFor="mabini">Mabini</label>
                    </div>
                    <div className="checkbox-control">
                      <input
                        type="checkbox"
                        id="malvar"
                        name="select-campus[]"
                        className="campus-bsu"
                        defaultValue="Malvar"
                      />
                      <label htmlFor="malvar">Malvar</label>
                    </div>
                    <div className="checkbox-control">
                      <input
                        type="checkbox"
                        id="nasugbu"
                        name="select-campus[]"
                        className="campus-bsu"
                        defaultValue="Nasugbu"
                      />
                      <label htmlFor="nasugbu">Nasugbu</label>
                    </div>
                    <div className="checkbox-control">
                      <input
                        type="checkbox"
                        id="pb-main"
                        name="select-campus[]"
                        className="campus-bsu"
                        defaultValue="Pablo Borbon"
                      />
                      <label htmlFor="pb-main">Pablo Borbon</label>
                    </div>
                    <div className="checkbox-control">
                      <input
                        type="checkbox"
                        id="rosario"
                        name="select-campus[]"
                        className="campus-bsu"
                        defaultValue="Rosario"
                      />
                      <label htmlFor="rosario">Rosario</label>
                    </div>
                  </div>
                  <input type="submit" defaultValue="Filter" />
                </form>
              </div>
            </div>
          </div>
        </div>
        <div className="table">
          {/*?php
              require_once "functionalities/articles-data.php";
          ?*/}
        </div>
        <div className="table-footer">
          {/*?php
          require_once "functionalities/articles-pagination.php";
      ?*/}
        </div>
      </div>
    </section>
  );
};

export default Articles;

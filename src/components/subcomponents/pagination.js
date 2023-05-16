import React from "react";

function Pagination(props) {
    const { currentPage, totalPages, handlePageChange } = props;

    // Create an array of page numbers for the pagination
    //work in progress...
    const pageNumbers = [];
    for (let i = 1; i <= totalPages; i++) {
        pageNumbers.push(i);
    }

    return (
        <nav>
            <ul className="pagination">
                {pageNumbers.map((pageNumber) => (
                    <li key={pageNumber} className={pageNumber === currentPage ? "page-item active" : "page-item"}>
                        <a className="page-link" href="my-app/src/components/subcomponents/pagination" onClick={() => handlePageChange(pageNumber)}>
                            {pageNumber}
                        </a>
                    </li>
                ))}
            </ul>
        </nav>
    );
}

export default Pagination;

interface ContainerProps {
    children: React.ReactNode;
  }
  
  const Container: React.FC<ContainerProps> = ({ children }) => {
    return <div className="max-auto max-w-8xl">{children}</div>;
  };
  
  export default Container;